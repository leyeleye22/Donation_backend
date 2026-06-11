<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 20px;">
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;">
<tr><td style="padding:32px 40px;">
@if($subscriberName)
<p style="font-size:14px;color:#888;margin:0 0 16px;">Bonjour {{ $subscriberName }},</p>
@endif
<div style="font-size:15px;color:#555;line-height:1.6;">
{!! $emailContent !!}
</div>
</td></tr>
<tr><td style="background:#f8f5ef;padding:20px 40px;text-align:center;font-size:12px;color:#999;">
Vous recevez cet email car vous etes abonne a notre newsletter.<br>
<a href="{{ config('services.frontend.url') }}/newsletter/unsubscribe?email=PLACEHOLDER" style="color:#d97706;">Se desabonner</a>
</td></tr>
</table>
</td></tr></table>
</body>
</html>
