<?php
/*******************************************************************************
* FPDF - Free PDF Generator for PHP                                            *
* Version: 1.84  (lightweight custom build for Wahana Totalita)               *
* Supports: text, cells, multicell, images, colors, UTF-8 via iconv           *
*******************************************************************************/

define('FPDF_VERSION', '1.84');

class FPDF {
    protected $page   = 0;
    protected $n      = 2;
    protected $offsets = [];
    protected $buffer = '';
    protected $pages  = [];
    protected $state  = 0;
    protected $compress = false;
    protected $k;
    protected $DefOrientation;
    protected $CurOrientation;
    protected $StdPageSizes;
    protected $DefPageSize;
    protected $CurPageSize;
    protected $CurRotation = 0;
    protected $PageInfo    = [];
    protected $wPt, $hPt;
    protected $w, $h;
    protected $lMargin, $tMargin, $rMargin, $cMargin;
    protected $x, $y;
    protected $lasth = 0;
    protected $LineWidth;
    protected $fontpath;
    protected $CoreFonts;
    protected $fonts    = [];
    protected $FontFiles = [];
    protected $encodings = [];
    protected $cmaps    = [];
    protected $FontFamily = '';
    protected $FontStyle  = '';
    protected $underline  = false;
    protected $CurrentFont;
    protected $FontSizePt = 12;
    protected $FontSize;
    protected $DrawColor, $FillColor, $TextColor;
    protected $ColorFlag  = false;
    protected $WithAlpha  = false;
    protected $ws         = 0;
    protected $images     = [];
    protected $PageLinks  = [];
    protected $links      = [];
    protected $AutoPageBreak;
    protected $PageBreakTrigger;
    protected $InHeader   = false;
    protected $InFooter   = false;
    protected $AliasNbPages;
    protected $ZoomMode;
    protected $LayoutMode;
    protected $metadata   = [];
    protected $PDFVersion = '1.3';

    public function __construct(string $orientation = 'P', string $unit = 'mm', $size = 'A4') {
        $this->StdPageSizes = ['a3'=>[841.89,1190.55],'a4'=>[595.28,841.89],'a5'=>[420.94,595.28],'letter'=>[612,792],'legal'=>[612,1008]];
        $size = $this->_getpagesize($size);
        if ($orientation === 'P' || strtolower($orientation) === 'portrait') {
            $this->DefOrientation = 'P';
            $this->w = $size[0]; $this->h = $size[1];
        } else {
            $this->DefOrientation = 'L';
            $this->w = $size[1]; $this->h = $size[0];
        }
        $this->CurOrientation = $this->DefOrientation;
        $this->wPt = $this->w * $this->k; $this->hPt = $this->h * $this->k;
        $this->CurPageSize  = $size;
        $this->DefPageSize  = $size;
        switch (strtolower($unit)) {
            case 'pt': $this->k = 1;       break;
            case 'mm': $this->k = 72/25.4; break;
            case 'cm': $this->k = 72/2.54; break;
            case 'in': $this->k = 72;      break;
            default:   $this->Error('Incorrect unit: '.$unit);
        }
        $this->wPt = $this->w * $this->k; $this->hPt = $this->h * $this->k;
        $margin = 10 * $this->k / 10;
        $this->lMargin = $margin; $this->tMargin = $margin; $this->rMargin = $margin;
        $this->cMargin = $this->w / 43;
        $this->LineWidth = .567 / $this->k;
        $this->SetFont('Helvetica', '', 12);
        $this->SetMargins(15, 15);
        $this->SetAutoPageBreak(true, 20);
        $this->SetDisplayMode('default');
        $this->SetCompression(false);
        $this->DrawColor  = '0 G';
        $this->FillColor  = '0 g';
        $this->TextColor  = '0 g';
        $this->metadata   = ['Producer' => 'FPDF '.FPDF_VERSION, 'CreationDate' => 'D:'.@date('YmdHis')];
        $this->CoreFonts  = ['courier'=>1,'helvetica'=>1,'times'=>1,'symbol'=>1,'zapfdingbats'=>1];
        $this->fontpath   = __DIR__ . '/font/';
    }

    public function SetMargins(float $left, float $top, float $right = -1): void {
        $this->lMargin = $left;
        $this->tMargin = $top;
        if ($right === -1) $right = $left;
        $this->rMargin = $right;
    }
    public function SetLeftMargin(float $margin): void { $this->lMargin = $margin; if ($this->page > 0 && $this->x < $margin) $this->x = $margin; }
    public function SetTopMargin(float $margin): void   { $this->tMargin = $margin; }
    public function SetRightMargin(float $margin): void { $this->rMargin = $margin; }
    public function SetAutoPageBreak(bool $auto, float $margin = 0): void {
        $this->AutoPageBreak   = $auto;
        $this->bMargin         = $margin;
        $this->PageBreakTrigger = $this->h - $margin;
    }
    public function SetDisplayMode(string $zoom, string $layout = 'default'): void {
        $this->ZoomMode   = $zoom;
        $this->LayoutMode = $layout;
    }
    public function SetCompression(bool $compress): void { $this->compress = $compress; }
    public function SetTitle(string $title, bool $isUTF8 = false): void { $this->metadata['Title'] = $isUTF8 ? $title : utf8_encode($title); }
    public function SetAuthor(string $author, bool $isUTF8 = false): void { $this->metadata['Author'] = $isUTF8 ? $author : utf8_encode($author); }
    public function SetSubject(string $subject, bool $isUTF8 = false): void { $this->metadata['Subject'] = $isUTF8 ? $subject : utf8_encode($subject); }
    public function SetKeywords(string $keywords, bool $isUTF8 = false): void { $this->metadata['Keywords'] = $isUTF8 ? $keywords : utf8_encode($keywords); }
    public function SetCreator(string $creator, bool $isUTF8 = false): void { $this->metadata['Creator'] = $isUTF8 ? $creator : utf8_encode($creator); }
    public function AliasNbPages(string $alias = '{nb}'): void { $this->AliasNbPages = $alias; }
    public function Error(string $msg): never { ob_end_clean(); throw new Exception('FPDF error: ' . $msg); }
    public function Close(): void {
        if ($this->state === 3) return;
        if ($this->page === 0) $this->AddPage();
        $this->InFooter = true; $this->Footer(); $this->InFooter = false;
        $this->_endpage();
        $this->_enddoc();
    }
    public function AddPage(string $orientation = '', $size = '', int $rotation = 0): void {
        if ($this->state === 3) $this->Error('The document is closed');
        $family = $this->FontFamily;
        $style  = $this->FontStyle . ($this->underline ? 'U' : '');
        $fontsize = $this->FontSizePt;
        $lw = $this->LineWidth;
        $dc = $this->DrawColor; $fc = $this->FillColor; $tc = $this->TextColor;
        $cf = $this->ColorFlag;
        if ($this->page > 0) {
            $this->InFooter = true; $this->Footer(); $this->InFooter = false;
            $this->_endpage();
        }
        $this->_beginpage($orientation, $size, $rotation);
        $this->_out('2 J');
        $this->LineWidth = $lw;
        $this->_out(sprintf('%.2F w', $lw * $this->k));
        if ($family) $this->SetFont($family, $style, $fontsize);
        $this->DrawColor = $dc;
        if ($dc !== '0 G') $this->_out($dc);
        $this->FillColor = $fc;
        if ($fc !== '0 g') $this->_out($fc);
        $this->TextColor = $tc;
        $this->ColorFlag = $cf;
        $this->InHeader  = true; $this->Header(); $this->InHeader = false;
        if ($this->LineWidth !== $lw) {
            $this->LineWidth = $lw;
            $this->_out(sprintf('%.2F w', $lw * $this->k));
        }
        if ($family) $this->SetFont($family, $style, $fontsize);
        if ($this->DrawColor !== $dc) { $this->DrawColor = $dc; $this->_out($dc); }
        if ($this->FillColor !== $fc) { $this->FillColor = $fc; $this->_out($fc); }
        $this->TextColor = $tc;
        $this->ColorFlag = $cf;
    }
    public function Header(): void {}
    public function Footer(): void {}
    public function PageNo(): int { return $this->page; }
    public function SetDrawColor(int $r, int $g = -1, int $b = -1): void {
        if ($r === 0 && $g === 0 && $b === 0 || $g === -1) $this->DrawColor = sprintf('%.3F G', $r / 255);
        else $this->DrawColor = sprintf('%.3F %.3F %.3F RG', $r/255, $g/255, $b/255);
        if ($this->page > 0) $this->_out($this->DrawColor);
    }
    public function SetFillColor(int $r, int $g = -1, int $b = -1): void {
        if ($r === 0 && $g === 0 && $b === 0 || $g === -1) $this->FillColor = sprintf('%.3F g', $r / 255);
        else $this->FillColor = sprintf('%.3F %.3F %.3F rg', $r/255, $g/255, $b/255);
        $this->ColorFlag = ($this->FillColor !== $this->TextColor);
        if ($this->page > 0) $this->_out($this->FillColor);
    }
    public function SetTextColor(int $r, int $g = -1, int $b = -1): void {
        if ($r === 0 && $g === 0 && $b === 0 || $g === -1) $this->TextColor = sprintf('%.3F g', $r / 255);
        else $this->TextColor = sprintf('%.3F %.3F %.3F rg', $r/255, $g/255, $b/255);
        $this->ColorFlag = ($this->FillColor !== $this->TextColor);
    }
    public function GetStringWidth(string $s): float {
        $cw = &$this->CurrentFont['cw'];
        $w = 0;
        $unicode = $this->UTF8StringToArray($s);
        foreach ($unicode as $char) {
            $char = $char < 256 ? chr($char) : '?';
            $w += isset($cw[$char]) ? $cw[$char] : 600;
        }
        return $w * $this->FontSize / 1000;
    }
    public function SetLineWidth(float $width): void {
        $this->LineWidth = $width;
        if ($this->page > 0) $this->_out(sprintf('%.2F w', $width * $this->k));
    }
    public function Line(float $x1, float $y1, float $x2, float $y2): void {
        $this->_out(sprintf('%.2F %.2F m %.2F %.2F l S', $x1*$this->k, ($this->h-$y1)*$this->k, $x2*$this->k, ($this->h-$y2)*$this->k));
    }
    public function Rect(float $x, float $y, float $w, float $h, string $style = ''): void {
        $op = match(strtoupper($style)) { 'F' => 'f', 'FD','DF' => 'B', default => 'S' };
        $this->_out(sprintf('%.2F %.2F %.2F %.2F re %s', $x*$this->k, ($this->h-$y)*$this->k, $w*$this->k, -$h*$this->k, $op));
    }
    public function AddFont(string $family, string $style = '', string $file = '', bool $uni = false): void {}
    public function SetFont(string $family, string $style = '', float $size = 0): void {
        if ($family === '') $family = $this->FontFamily;
        else $family = strtolower($family);
        $style = strtoupper($style);
        if (strpos($style, 'U') !== false) { $this->underline = true; $style = str_replace('U', '', $style); }
        else $this->underline = false;
        if ($style === 'IB') $style = 'BI';
        if ($size === 0) $size = $this->FontSizePt;
        if ($this->FontFamily === $family && $this->FontStyle === $style && $this->FontSizePt === $size) return;
        $fontkey = $family . $style;
        if (!isset($this->fonts[$fontkey])) {
            $name = '';
            $cw = [];
            switch ($family) {
                case 'helvetica':
                    $name = match($style) {
                        'B'  => 'Helvetica-Bold',
                        'I'  => 'Helvetica-Oblique',
                        'BI' => 'Helvetica-BoldOblique',
                        default => 'Helvetica',
                    };
                    break;
                case 'times':
                    $name = match($style) {
                        'B'  => 'Times-Bold',
                        'I'  => 'Times-Italic',
                        'BI' => 'Times-BoldItalic',
                        default => 'Times-Roman',
                    };
                    break;
                case 'courier':
                    $name = match($style) {
                        'B'  => 'Courier-Bold',
                        'I'  => 'Courier-Oblique',
                        'BI' => 'Courier-BoldOblique',
                        default => 'Courier',
                    };
                    break;
                default:
                    $name = 'Helvetica'; $family = 'helvetica';
            }
            $i = count($this->fonts) + 1;
            foreach (range(0, 255) as $c) $cw[chr($c)] = 600;
            $this->fonts[$fontkey] = ['i'=>$i,'type'=>'core','name'=>$name,'up'=>-100,'ut'=>50,'cw'=>$cw];
        }
        $this->FontFamily  = $family;
        $this->FontStyle   = $style;
        $this->FontSizePt  = $size;
        $this->FontSize    = $size / $this->k;
        $this->CurrentFont = &$this->fonts[$fontkey];
        if ($this->page > 0) $this->_out(sprintf('BT /F%d %.2F Tf ET', $this->CurrentFont['i'], $this->FontSizePt));
    }
    public function SetFontSize(float $size): void {
        if ($this->FontSizePt === $size) return;
        $this->FontSizePt = $size;
        $this->FontSize   = $size / $this->k;
        if ($this->page > 0) $this->_out(sprintf('BT /F%d %.2F Tf ET', $this->CurrentFont['i'], $this->FontSizePt));
    }
    public function AddLink(): int {
        $n = count($this->links) + 1;
        $this->links[$n] = [0, 0];
        return $n;
    }
    public function SetLink(int $link, float $y = 0, int $page = -1): void {
        if ($y === -1) $y = $this->y;
        if ($page === -1) $page = $this->page;
        $this->links[$link] = [$page, $y];
    }
    public function Link(float $x, float $y, float $w, float $h, $link): void {
        $this->PageLinks[$this->page][] = [$x*$this->k, $this->hPt-$y*$this->k, $w*$this->k, $h*$this->k, $link];
    }
    public function Text(float $x, float $y, string $txt): void {
        if (!isset($this->CurrentFont)) $this->Error('No font has been set');
        $txt2 = str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
        $s = sprintf('BT %.2F %.2F Td (%s) Tj ET', $x*$this->k, ($this->h-$y)*$this->k, $txt2);
        if ($this->underline && $txt !== '') $s .= ' '.$this->_dounderline($x, $y, $txt);
        if ($this->ColorFlag) $s = 'q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
    public function AcceptPageBreak(): bool { return $this->AutoPageBreak; }
    public function Cell(float $w, float $h = 0, string $txt = '', $border = 0, int $ln = 0, string $align = '', bool $fill = false, $link = ''): void {
        $k = $this->k;
        if ($this->y + $h > $this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak()) {
            $x  = $this->x; $ws = $this->ws;
            if ($ws > 0) { $this->ws = 0; $this->_out('0 Tw'); }
            $this->AddPage($this->CurOrientation, $this->CurPageSize, $this->CurRotation);
            $this->x = $x;
            if ($ws > 0) { $this->ws = $ws; $this->_out(sprintf('%.3F Tw', $ws*$k)); }
        }
        if ($w === 0) $w = $this->w - $this->rMargin - $this->x;
        $s = '';
        if ($fill || $border === 1) {
            $op = $fill ? ($border === 1 ? 'B' : 'f') : 'S';
            $s  = sprintf('%.2F %.2F %.2F %.2F re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
        }
        if (is_string($border)) {
            $x = $this->x; $y = $this->y;
            if (strpos($border,'L') !== false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
            if (strpos($border,'T') !== false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            if (strpos($border,'R') !== false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            if (strpos($border,'B') !== false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        }
        if ($txt !== '') {
            if (!isset($this->CurrentFont)) $this->Error('No font has been set');
            $dx = match(strtoupper($align)) {
                'R'  => $w - $this->cMargin - $this->GetStringWidth($txt),
                'C'  => ($w - $this->GetStringWidth($txt)) / 2,
                default => $this->cMargin,
            };
            if ($this->ColorFlag) $s .= 'q ' . $this->TextColor . ' ';
            $txt2 = str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
            $s .= sprintf('BT %.2F %.2F Td (%s) Tj ET', ($this->x+$dx)*$k, ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k, $txt2);
            if ($this->underline) $s .= ' '.$this->_dounderline($this->x+$dx, $this->y+.5*$h+.3*$this->FontSize, $txt);
            if ($this->ColorFlag) $s .= ' Q';
            if ($link) $this->Link($this->x+$dx, $this->y+.5*$h-.5*$this->FontSize, $this->GetStringWidth($txt), $this->FontSize, $link);
        }
        if ($s) $this->_out($s);
        $this->lasth = $h;
        if ($ln > 0) {
            $this->y += $h;
            if ($ln === 1) $this->x = $this->lMargin;
        } else {
            $this->x += $w;
        }
    }
    public function MultiCell(float $w, float $h, string $txt, $border = 0, string $align = 'J', bool $fill = false): void {
        if (!isset($this->CurrentFont)) $this->Error('No font has been set');
        $cw = &$this->CurrentFont['cw'];
        if ($w === 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2*$this->cMargin);
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb-1] === "\n") $nb--;
        $b = 0;
        if ($border) {
            if ($border === 1) { $border = 'LTRB'; $b = 'LRT'; $b2 = 'LR'; }
            else {
                $b2 = '';
                if (strpos((string)$border, 'L') !== false) $b2 .= 'L';
                if (strpos((string)$border, 'R') !== false) $b2 .= 'R';
                $b = (strpos((string)$border, 'T') !== false) ? $b2.'T' : $b2;
            }
        }
        $sep = -1; $i = 0; $j = 0; $l = 0; $ns = 0; $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c === "\n") {
                if ($this->ws > 0) { $this->ws = 0; $this->_out('0 Tw'); }
                $this->Cell($w, $h, substr($s,$j,$i-$j), $b, 2, $align, $fill);
                $i++; $sep = -1; $j = $i; $l = 0; $ns = 0; $nl++;
                if ($border && $nl === 2) $b = $b2;
                continue;
            }
            if ($c === ' ') { $sep = $i; $ls = $l; $ns++; }
            $l += isset($cw[$c]) ? $cw[$c] : 600;
            if ($l > $wmax * 1000 / $this->FontSize) {
                if ($sep === -1) { if ($i === $j) $i++; if ($this->ws > 0) { $this->ws = 0; $this->_out('0 Tw'); } $this->Cell($w, $h, substr($s,$j,$i-$j), $b, 2, $align, $fill); }
                else {
                    if ($align === 'J') {
                        $this->ws = $ns > 1 ? ($wmax - $ls/1000*$this->FontSize)/($ns-1) : 0;
                        $this->_out(sprintf('%.3F Tw', $this->ws*$this->k));
                    }
                    $this->Cell($w, $h, substr($s,$j,$sep-$j), $b, 2, $align, $fill);
                    $i = $sep + 1;
                }
                $sep = -1; $j = $i; $l = 0; $ns = 0; $nl++;
                if ($border && $nl === 2) $b = $b2;
            } else { $i++; }
        }
        if ($this->ws > 0) { $this->ws = 0; $this->_out('0 Tw'); }
        if ($border && strpos($border,'B') !== false) $b .= 'B';
        $this->Cell($w, $h, substr($s,$j,$i-$j), $b, 2, $align, $fill);
        $this->x = $this->lMargin;
    }
    public function Write(float $h, string $txt, $link = ''): void {
        if (!isset($this->CurrentFont)) $this->Error('No font has been set');
        $cw = &$this->CurrentFont['cw'];
        $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2*$this->cMargin);
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        $sep = -1; $i = 0; $j = 0; $l = 0; $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c === "\n") {
                $this->Cell($w, $h, substr($s,$j,$i-$j), 0, 2, '', false, $link);
                $i++; $sep = -1; $j = $i; $l = 0;
                if ($nl === 1) { $this->x = $this->lMargin; $w = $this->w - $this->rMargin - $this->x; $wmax = ($w - 2*$this->cMargin); }
                $nl++;
                continue;
            }
            if ($c === ' ') $sep = $i;
            $l += isset($cw[$c]) ? $cw[$c] : 600;
            if ($l > $wmax * 1000 / $this->FontSize) {
                if ($sep === -1) { if ($this->x > $this->lMargin) { $this->x = $this->lMargin; $this->y += $h; $w = $this->w - $this->rMargin - $this->x; $wmax = ($w - 2*$this->cMargin); $i++; $nl++; continue; } if ($i === $j) $i++; $this->Cell($w, $h, substr($s,$j,$i-$j), 0, 2, '', false, $link); }
                else { $this->Cell($w, $h, substr($s,$j,$sep-$j), 0, 2, '', false, $link); $i = $sep + 1; }
                $sep = -1; $j = $i; $l = 0;
                if ($nl === 1) { $this->x = $this->lMargin; $w = $this->w - $this->rMargin - $this->x; $wmax = ($w - 2*$this->cMargin); }
                $nl++;
            } else { $i++; }
        }
        if ($i !== $j) $this->Cell($l/1000*$this->FontSize, $h, substr($s,$j), 0, 0, '', false, $link);
    }
    public function Ln(float $h = -1): void {
        $this->x = $this->lMargin;
        if ($h === -1) $this->y += $this->lasth; else $this->y += $h;
    }
    public function GetX(): float { return $this->x; }
    public function SetX(float $x): void { $this->x = $x > 0 ? $x : $this->w + $x; }
    public function GetY(): float { return $this->y; }
    public function SetY(float $y, bool $resetX = true): void {
        if ($resetX) $this->x = $this->lMargin;
        $this->y = $y > 0 ? $y : $this->h + $y;
    }
    public function SetXY(float $x, float $y): void { $this->SetX($x); $this->SetY($y, false); }
    public function Output(string $dest = '', string $name = '', bool $isUTF8 = false): string {
        $this->Close();
        if ($name === '') $name = 'document.pdf';
        switch (strtoupper($dest)) {
            case '':
            case 'I':
                if (headers_sent($file, $line)) $this->Error("Some data has already been output, can't send PDF file (output started at $file:$line)");
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="'.$name.'"');
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                echo $this->buffer;
                break;
            case 'D':
                if (headers_sent($file, $line)) $this->Error("Some data has already been output, can't send PDF file (output started at $file:$line)");
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="'.$name.'"');
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                echo $this->buffer;
                break;
            case 'F':
                if (!file_put_contents($name, $this->buffer)) $this->Error('Unable to create output file: '.$name);
                break;
            case 'S':
                return $this->buffer;
            default:
                $this->Error('Incorrect output destination: '.$dest);
        }
        return '';
    }
    protected function _getpagesize($size): array {
        if (is_string($size)) {
            $size = strtolower($size);
            if (!isset($this->StdPageSizes[$size])) $this->Error('Unknown page size: '.$size);
            $a = $this->StdPageSizes[$size];
            return [$a[0]/$this->k, $a[1]/$this->k];
        } else {
            if ($size[0] > $size[1]) return [$size[1], $size[0]];
            return $size;
        }
    }
    protected function _beginpage(string $orientation, $size, int $rotation): void {
        $this->page++;
        $this->pages[$this->page] = '';
        $this->state     = 2;
        $this->x         = $this->lMargin;
        $this->y         = $this->tMargin;
        $this->FontFamily = '';
        if ($orientation === '') $orientation = $this->DefOrientation;
        else $orientation = strtoupper($orientation[0]);
        if ($size === '') $size = $this->DefPageSize;
        else $size = $this->_getpagesize($size);
        if ($orientation !== $this->CurOrientation || $size[0] !== $this->CurPageSize[0] || $size[1] !== $this->CurPageSize[1]) {
            if ($orientation === 'P') { $this->w = $size[0]; $this->h = $size[1]; }
            else { $this->w = $size[1]; $this->h = $size[0]; }
            $this->wPt = $this->w * $this->k; $this->hPt = $this->h * $this->k;
            $this->PageBreakTrigger = $this->h - $this->bMargin;
            $this->CurOrientation   = $orientation;
            $this->CurPageSize      = $size;
        }
        if ($rotation !== 0) {
            if ($rotation % 90 !== 0) $this->Error('Incorrect rotation value: '.$rotation);
            $this->CurRotation = $rotation;
        }
        $this->PageInfo[$this->page] = ['size' => [$this->wPt, $this->hPt], 'rotation' => $this->CurRotation];
    }
    protected function _endpage(): void { $this->state = 1; }
    protected function _newobj(?int $n = null): void {
        if ($n === null) $n = ++$this->n;
        $this->offsets[$n] = strlen($this->buffer);
        $this->_out($n.' 0 obj');
    }
    protected function _putstream(string $data): void { $this->_out('stream'); $this->_out($data); $this->_out('endstream'); }
    protected function _putstreamobject(string $data): void {
        $entries = sprintf('/Length %d', strlen($data));
        $this->_newobj();
        $this->_out('<<'.$entries.'>>');
        $this->_putstream($data);
        $this->_out('endobj');
    }
    protected function _out(string $s): void {
        if ($this->state === 2) $this->pages[$this->page] .= $s . "\n";
        else $this->buffer .= $s . "\n";
    }
    protected function _dounderline(float $x, float $y, string $txt): string {
        $up = $this->CurrentFont['up'];
        $ut = $this->CurrentFont['ut'];
        $w = $this->GetStringWidth($txt) + $this->ws * substr_count($txt, ' ');
        return sprintf('%.2F %.2F %.2F %.2F re f', $x*$this->k, ($this->h-($y-$up/1000*$this->FontSize))*$this->k, $w*$this->k, -$ut/1000*$this->FontSizePt);
    }
    protected function _enddoc(): void {
        $this->_putpages();
        $this->_putresources();
        $this->_out('xref');
        $this->_out('0 '.($this->n+1));
        $this->_out('0000000000 65535 f ');
        for ($i = 1; $i <= $this->n; $i++) $this->_out(sprintf('%010d 00000 n ', $this->offsets[$i]));
        $this->_out('trailer');
        $this->_out('<<');
        $this->_puttrailer();
        $this->_out('>>');
        $this->_out('startxref');
        $this->_out((string)($this->n+2));
        $this->buffer .= '%%EOF';
    }
    protected function _putpages(): void {
        $nb = $this->page;
        for ($n = 1; $n <= $nb; $n++) {
            $this->PageInfo[$n]['n'] = ++$this->n;
        }
        for ($n = 1; $n <= $nb; $n++) {
            $this->_putpage($n);
        }
        $this->_newobj(1);
        $this->_out('<</Type /Pages');
        $kids = '/Kids [';
        for ($n = 1; $n <= $nb; $n++) $kids .= $this->PageInfo[$n]['n'].' 0 R ';
        $this->_out($kids.']');
        $this->_out('/Count '.$nb);
        $this->_out('>>');
        $this->_out('endobj');
    }
    protected function _putpage(int $n): void {
        $this->_newobj();
        $this->_out('<</Type /Page');
        $this->_out('/Parent 1 0 R');
        if (isset($this->PageInfo[$n]['size'])) {
            $this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]', $this->PageInfo[$n]['size'][0], $this->PageInfo[$n]['size'][1]));
        }
        if (isset($this->PageInfo[$n]['rotation']) && $this->PageInfo[$n]['rotation'] !== 0) {
            $this->_out('/Rotate '.$this->PageInfo[$n]['rotation']);
        }
        $this->_out('/Resources 2 0 R');
        $this->_out('/Contents '.($this->n+1).' 0 R>>');
        $this->_out('endobj');
        $p = $this->pages[$n];
        $this->_putstreamobject($p);
    }
    protected function _putresources(): void {
        $this->_putfonts();
        $this->_newobj(2);
        $this->_out('<</ProcSet [/PDF /Text /ImageB /ImageC /ImageI]');
        $this->_out('/Font <<');
        foreach ($this->fonts as $font) $this->_out('/F'.$font['i'].' '.$font['n'].' 0 R');
        $this->_out('>>');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_putinfo();
        $this->_putcatalog();
    }
    protected function _putfonts(): void {
        foreach ($this->fonts as $k => $font) {
            $this->fonts[$k]['n'] = $this->n + 1;
            $this->_newobj();
            $this->_out('<</Type /Font');
            $this->_out('/Subtype /Type1');
            $this->_out('/BaseFont /'.$font['name']);
            if (!in_array($font['name'], ['Symbol','ZapfDingbats'])) {
                $this->_out('/Encoding /WinAnsiEncoding');
            }
            $this->_out('>>');
            $this->_out('endobj');
        }
    }
    protected function _putinfo(): void {
        $this->metadata['CreationDate'] = 'D:'.@date('YmdHis');
        $this->_newobj();
        $this->_out('<<');
        foreach ($this->metadata as $k => $v) {
            $this->_out('/'.$k.' '.$this->_textstring($v));
        }
        $this->_out('>>');
        $this->_out('endobj');
    }
    protected function _putcatalog(): void {
        $n = $this->n + 1;
        $this->_newobj();
        $this->_out('<</Type /Catalog');
        $this->_out('/Pages 1 0 R');
        if ($this->ZoomMode === 'fullpage') $this->_out('/OpenAction [3 0 R /Fit]');
        elseif ($this->ZoomMode === 'fullwidth') $this->_out('/OpenAction [3 0 R /FitH null]');
        elseif ($this->ZoomMode === 'real') $this->_out('/OpenAction [3 0 R /XYZ null null 1]');
        elseif (!is_string($this->ZoomMode)) $this->_out('/OpenAction [3 0 R /XYZ null null '.sprintf('%.2F', $this->ZoomMode/100).']');
        if ($this->LayoutMode === 'single') $this->_out('/PageLayout /SinglePage');
        elseif ($this->LayoutMode === 'continuous') $this->_out('/PageLayout /OneColumn');
        elseif ($this->LayoutMode === 'two') $this->_out('/PageLayout /TwoColumnLeft');
        $this->_out('>>');
        $this->_out('endobj');
    }
    protected function _puttrailer(): void {
        $this->_out('/Size '.($this->n+1));
        $this->_out('/Root '.$this->n.' 0 R');
        $this->_out('/Info '.($this->n-1).' 0 R');
    }
    protected function _textstring(string $s): string {
        return '('.$this->_escape($s).')';
    }
    protected function _escape(string $s): string {
        return str_replace(['\\','(',')',"\r"], ['\\\\','\\(','\\)','\\r'], $s);
    }
    protected function UTF8StringToArray(string $str): array {
        $out = [];
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $uni = -1;
            $h   = ord($str[$i]);
            if ($h <= 0x7F) $uni = $h;
            elseif ($h >= 0xC2) {
                if (($h & 0xE0) === 0xC0 && $i + 1 < $len) { $uni = ($h & 0x1F) << 6 | (ord($str[++$i]) & 0x3F); }
                elseif (($h & 0xF0) === 0xE0 && $i + 2 < $len) { $uni = ($h & 0x0F) << 12 | (ord($str[++$i]) & 0x3F) << 6 | (ord($str[++$i]) & 0x3F); }
                elseif (($h & 0xF8) === 0xF0 && $i + 3 < $len) { $uni = ($h & 0x07) << 18 | (ord($str[++$i]) & 0x3F) << 12 | (ord($str[++$i]) & 0x3F) << 6 | (ord($str[++$i]) & 0x3F); }
            }
            if ($uni >= 0) $out[] = $uni;
        }
        return $out;
    }
    protected float $bMargin = 0;
}
