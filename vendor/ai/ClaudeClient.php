<?php
/**
 * ClaudeClient — cURL wrapper for Anthropic Claude API.
 * Free to use with your own API key.
 * Budget: ~Rp 2.4 juta per 10,000 short articles (claude-haiku-3-5).
 * For lead analysis and chat: use claude-haiku-3-5 (cheapest).
 * For long document analysis: use claude-3-5-sonnet-20241022.
 */
class ClaudeClient {
    private const API_URL  = 'https://api.anthropic.com/v1/messages';
    private const VERSION  = '2023-06-01';
    private string $apiKey;
    private int    $timeout;

    public function __construct(string $apiKey = '', int $timeout = 30) {
        $this->apiKey  = $apiKey ?: (defined('CLAUDE_API_KEY') ? CLAUDE_API_KEY : '');
        $this->timeout = $timeout;
    }

    public function isConfigured(): bool { return !empty($this->apiKey); }

    /**
     * Send a single user message and get a text response.
     *
     * @param  string $prompt     The user prompt
     * @param  string $system     Optional system prompt
     * @param  string $model      Model to use
     * @param  int    $maxTokens  Max output tokens
     * @return array              ['success'=>bool, 'text'=>string, 'error'=>string, 'tokens'=>int]
     */
    public function message(
        string $prompt,
        string $system     = '',
        string $model      = 'claude-haiku-4-5',
        int    $maxTokens  = 1024,
        bool   $jsonMode   = false
    ): array {
        if (!$this->isConfigured()) {
            return ['success'=>false,'text'=>'','error'=>'Claude API key not configured','tokens'=>0];
        }
        $body = [
            'model'      => $model,
            'max_tokens' => $maxTokens,
            'messages'   => [['role'=>'user','content'=>$prompt]],
        ];
        if ($system) $body['system'] = $system;

        $result = $this->post($body);
        if (!$result['success']) return $result;

        $data  = $result['data'];
        $text  = $data['content'][0]['text'] ?? '';
        $tokens= ($data['usage']['input_tokens'] ?? 0) + ($data['usage']['output_tokens'] ?? 0);
        return ['success'=>true,'text'=>trim($text),'error'=>'','tokens'=>$tokens];
    }

    /**
     * Analyze a lead and return an AI score + reason.
     * Used by marketing dashboard.
     */
    public function scoreLead(array $lead): array {
        $prompt = <<<PROMPT
Kamu adalah analis B2G (Business to Government) untuk perusahaan pelatihan K3 di Yogyakarta bernama Wahana Totalita Konsultan.

Data lead berikut:
- Nama: {$lead['name']}
- Email: {$lead['email']}
- Perusahaan: {$lead['company']}
- Jabatan: {$lead['jabatan']}
- Sumber: {$lead['source']}
- Pesan: {$lead['message']}

Tugasmu: Beri skor 0-100 untuk potensi konversi menjadi klien B2G (pelatihan K3 / sertifikasi BNSP untuk instansi pemerintah atau BUMN).

Jawab HANYA dalam format JSON:
{"score": <angka 0-100>, "reason": "<alasan singkat max 1 kalimat>", "priority": "<hot|warm|cold>"}
PROMPT;
        $result = $this->message($prompt, '', 'claude-haiku-4-5', 256);
        if (!$result['success']) return ['score'=>0,'reason'=>'API error','priority'=>'cold'];
        $json = json_decode($result['text'], true);
        if (!$json) {
            preg_match('/\{.*\}/s', $result['text'], $m);
            $json = $m ? json_decode($m[0], true) : null;
        }
        return [
            'score'    => (int)($json['score'] ?? 0),
            'reason'   => $json['reason'] ?? '',
            'priority' => $json['priority'] ?? 'cold',
        ];
    }

    /**
     * Generate 3 social media captions for a topic.
     */
    public function generateCaptions(string $topic, string $type = 'instagram'): array {
        $prompt = <<<PROMPT
Buat 3 variasi caption {$type} bahasa Indonesia tentang: "{$topic}"

Konteks: Wahana Totalita Konsultan — perusahaan pelatihan K3 & sertifikasi BNSP di Yogyakarta.
Tone: profesional tapi mudah dipahami, edukatif.
Format masing-masing caption:
- Hook kuat di baris pertama (stop scroll)
- Isi (2-3 kalimat edukasi)
- CTA (contoh: "DM kami untuk info pelatihan")
- 15-20 hashtag relevan

Jawab dalam format JSON:
{"captions": ["caption1", "caption2", "caption3"]}
PROMPT;
        $result = $this->message($prompt, '', 'claude-haiku-4-5', 1500);
        if (!$result['success']) return [];
        $json = json_decode($result['text'], true);
        if (!$json) {
            preg_match('/\{.*\}/s', $result['text'], $m);
            $json = $m ? json_decode($m[0], true) : null;
        }
        return $json['captions'] ?? [];
    }

    /**
     * Analyze a document for K3 compliance.
     */
    public function analyzeDocument(string $documentText, string $documentType = 'JSA'): array {
        $system = 'Kamu adalah ahli K3 (Keselamatan dan Kesehatan Kerja) Indonesia bersertifikasi BNSP dengan pengalaman 15 tahun. Analisis dokumen K3 secara detail dan berikan saran konstruktif dalam bahasa Indonesia.';
        $prompt = "Analisis dokumen {$documentType} berikut:\n\n{$documentText}\n\nBerikan:\n1. Skor kelengkapan (0-100)\n2. Poin kuat (max 3)\n3. Poin lemah / yang harus diperbaiki (max 5)\n4. Rekomendasi konkret\n5. Regulasi yang relevan (Permenaker / PP K3)\n\nJawab dalam format JSON: {\"score\": 85, \"strengths\": [], \"weaknesses\": [], \"recommendations\": [], \"regulations\": []}";
        $result = $this->message($prompt, $system, 'claude-haiku-4-5', 1500);
        if (!$result['success']) return ['score'=>0,'strengths'=>[],'weaknesses'=>[],'recommendations'=>[],'regulations'=>[]];
        $json = json_decode($result['text'], true);
        if (!$json) {
            preg_match('/\{.*\}/s', $result['text'], $m);
            $json = $m ? json_decode($m[0], true) : [];
        }
        return $json;
    }

    /**
     * Answer a K3 question (for AI chat / forum).
     */
    public function answerK3Question(string $question): string {
        $system = 'Kamu adalah asisten K3 (Keselamatan dan Kesehatan Kerja) Indonesia yang berpengetahuan luas. Jawab pertanyaan secara singkat, akurat, dan praktis dalam bahasa Indonesia. Sertakan nomor regulasi jika relevan (Permenaker, PP, UU). Akhiri dengan saran untuk menghubungi Wahana Totalita Konsultan untuk pelatihan lebih lanjut.';
        $result = $this->message($question, $system, 'claude-haiku-4-5', 600);
        return $result['success'] ? $result['text'] : 'Maaf, sistem AI sedang tidak tersedia. Silakan hubungi kami via WhatsApp.';
    }

    /**
     * Extract incident info from a news article.
     */
    public function extractIncidentData(string $articleText, string $sourceUrl): array {
        $prompt = <<<PROMPT
Dari artikel berita berikut, tentukan apakah ini tentang kecelakaan/insiden Keselamatan dan Kesehatan Kerja (K3) di tempat kerja.
Jika BUKAN tentang kecelakaan kerja, jawab persis: {"is_incident": false}

Jika YA, tulis konten edukatif K3 yang lengkap, akurat, dan berbasis fakta artikel. Jangan mengarang jumlah korban; jika tidak disebutkan, isi 0. Tulis dalam bahasa Indonesia.

Artikel:
{$articleText}

Sumber: {$sourceUrl}

Jawab HANYA dengan JSON valid (tanpa markdown):
{
  "is_incident": true,
  "title": "judul insiden yang jelas dan ramah SEO",
  "company": "nama perusahaan atau null",
  "province": "provinsi atau null",
  "city": "kota/kabupaten atau null",
  "industry": "industri (tambang/konstruksi/manufaktur/migas/dll)",
  "incident_type": "jenis insiden (jatuh/tertimpa/kebakaran/ledakan/tersengat/dll)",
  "incident_date": "YYYY-MM-DD atau null",
  "deaths": 0,
  "injured": 0,
  "description": "Analisis 250-400 kata: kronologi yang diketahui, konteks industri, dan dampak insiden. Faktual, tidak mengarang.",
  "root_cause": "Analisis akar penyebab dari sudut pandang K3 (unsafe act / unsafe condition / kegagalan sistem). 2-4 kalimat.",
  "regulation_violated": "Regulasi K3 Indonesia yang relevan beserta nomor yang benar (mis. UU No. 1/1970, PP No. 50/2012, Permenaker terkait).",
  "prevention": "4-6 langkah pencegahan K3 konkret yang sesuai jenis insiden ini. Tulis satu langkah per baris diawali dengan '- '."
}
PROMPT;
        $result = $this->message($prompt, '', 'claude-haiku-4-5', 2048, true);
        if (!$result['success']) return ['is_incident'=>false];
        $json = json_decode($result['text'], true);
        if (!$json) {
            preg_match('/\{.*\}/s', $result['text'], $m);
            $json = $m ? json_decode($m[0], true) : ['is_incident'=>false];
        }
        return $json ?: ['is_incident'=>false];
    }

    private function post(array $body): array {
        $json = json_encode($body, JSON_UNESCAPED_UNICODE);
        $ch   = curl_init(self::API_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $json,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'x-api-key: '         . $this->apiKey,
                'anthropic-version: ' . self::VERSION,
            ],
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        $code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err || $response === false) return ['success'=>false,'data'=>null,'error'=>$err,'tokens'=>0,'text'=>''];
        $data = json_decode($response, true);
        if ($code >= 400) {
            $errMsg = $data['error']['message'] ?? $response;
            return ['success'=>false,'data'=>$data,'error'=>$errMsg,'tokens'=>0,'text'=>''];
        }
        return ['success'=>true,'data'=>$data,'error'=>'','tokens'=>0,'text'=>''];
    }
}
