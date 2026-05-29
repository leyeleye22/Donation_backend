<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 20px;">
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;">
@if($post->image)
<tr><td><img src="{{ $post->image }}" alt="" style="width:100%;height:auto;display:block;" /></td></tr>
@endif
<tr><td style="padding:32px 40px;">
<h1 style="font-size:22px;color:#1a1a1a;margin:0 0 8px;">{{ $post->title }}</h1>
<p style="font-size:14px;color:#888;margin:0 0 16px;">
@if($post->category)<span style="color:#d97706;">{{ $post->category }}</span> &middot; @endif
{{ $post->published_at?->format('d/m/Y') }}
</p>
@if($post->excerpt)
<p style="font-size:15px;color:#555;line-height:1.6;margin:0 0 24px;">{{ $post->excerpt }}</p>
@endif
<p style="margin:0;">
<a href="{{ $frontendUrl }}/journal/{{ $post->slug }}" style="display:inline-block;background:#d97706;color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:bold;font-size:14px;">
Lire l'article complet
</a>
</p>
</td></tr>
<tr><td style="background:#f8f5ef;padding:20px 40px;text-align:center;font-size:12px;color:#999;">
Vous recevez cet email car vous etes abonne a notre newsletter.<br>
<a href="{{ $frontendUrl }}/newsletter/unsubscribe?email=PLACEHOLDER" style="color:#d97706;">Se desabonner</a>
</td></tr>
</table>
</td></tr></table>
</body>
</html>
