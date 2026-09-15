<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Laporan Diperbarui</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7f5; padding: 24px; color: #1f2937;">
    <div style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
        <div style="background: linear-gradient(135deg, #12372a, #436b5d); padding: 24px; color: #ffffff;">
            <h2 style="margin: 0; font-size: 24px;">Status laporan diperbarui</h2>
        </div>
        <div style="padding: 24px;">
            <p>Halo,</p>
            <p>Status laporan Anda dengan nomor tiket <strong>{{ $report->ticket_number }}</strong> telah diperbarui menjadi:</p>
            <p style="font-size: 24px; font-weight: bold; color: #12372a; margin: 16px 0;">{{ $report->status }}</p>
            <p><strong>Subjek:</strong> {{ $report->subject }}</p>
            <p>Terima kasih atas kesabaran Anda.</p>
        </div>
    </div>
</body>
</html>
