<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if (PHP_SAPI !== 'cli') { http_response_code(403); exit('CLI only'); }
$pdo = get_pdo();
$rules = $pdo->query("SELECT r.*, t.name AS course_name FROM training_recurring_rules r JOIN trainings t ON t.id=r.course_id WHERE r.is_active=1")->fetchAll();
$created = 0;

foreach ($rules as $r) {
    $ahead = max(1, min(12, (int)$r['months_ahead']));
    $today = new DateTimeImmutable('today');
    $currentMonth = new DateTimeImmutable('first day of this month');
    $configuredDay = min(max(1, (int)$r['day_of_month']), (int)$currentMonth->format('t'));
    $thisMonthStart = $currentMonth->setDate((int)$currentMonth->format('Y'), (int)$currentMonth->format('m'), $configuredDay);
    $baseMonth = $thisMonthStart >= $today ? $currentMonth : new DateTimeImmutable('first day of next month');
    for ($i = 0; $i < $ahead; $i++) {
        $month = $baseMonth->modify('+' . $i . ' months');
        $day = min(max(1, (int)$r['day_of_month']), (int)$month->format('t'));
        $start = $month->setDate((int)$month->format('Y'), (int)$month->format('m'), $day);
        $end = $start->modify('+' . max(0, (int)$r['duration_days'] - 1) . ' days');
        $exists = $pdo->prepare('SELECT id FROM training_batches WHERE course_id=? AND start_date=? AND mode=? LIMIT 1');
        $exists->execute([(int)$r['course_id'], $start->format('Y-m-d'), $r['mode']]);
        if ($exists->fetchColumn()) continue;
        $name = $r['course_name'] . ' - ' . $start->format('M Y');
        $stmt = $pdo->prepare("INSERT INTO training_batches (course_id,batch_name,start_date,end_date,mode,venue,max_participants,status,is_public,price,notes) VALUES (?,?,?,?,?,?,?,'planned',1,?,'Dibuat otomatis dari jadwal bulanan')");
        $stmt->execute([(int)$r['course_id'],$name,$start->format('Y-m-d'),$end->format('Y-m-d'),$r['mode'],$r['venue'],(int)$r['max_participants'],(float)$r['price']]);
        $created++;
    }
}
echo "Recurring schedules complete. Created: {$created}\n";
