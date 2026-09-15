<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Berhasil Dikirim</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7f5; padding: 24px; color: #1f2937;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
        <div style="background: linear-gradient(135deg, #12372a, #436b5d); padding: 24px; color: #ffffff;">
            <h2 style="margin: 0; font-size: 24px;">Laporan berhasil dikirim</h2>
        </div>
        <div style="padding: 24px;">
            <p>Halo,</p>
            <p>Laporan Anda telah berhasil masuk ke sistem dengan nomor tiket:</p>
            <p style="font-size: 24px; font-weight: bold; color: #12372a; margin: 16px 0;">{{ $report->ticket_number }}</p>
            <p><strong>Jenis:</strong> {{ $report->type_label }}</p>
            <p><strong>Subjek:</strong> {{ $report->subject }}</p>
            <p><strong>Status saat ini:</strong> {{ $report->status }}</p>
            <p>Tim kami akan segera menindaklanjuti laporan Anda.</p>
        </div>
    </div>
</body>
</html>
