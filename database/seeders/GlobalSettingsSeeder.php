<?php

namespace Database\Seeders;

use App\Models\GlobalSetting;
use Illuminate\Database\Seeder;

class GlobalSettingsSeeder extends Seeder
{
    public function run(): void
    {
        GlobalSetting::create([
            'site_name' => "Entr'aide pour servir l'humanite",
            'donation_cta_text' => 'Faire un don',
            'show_floating_button' => true,
            'floating_button_pages' => ['/', '/about', '/projects', '/journal', '/gallery', '/contact'],
            'footer_copyright' => "Entraide Pour Servir L Humanite. Tous droits reserves.",
            'footer_intro' => "Une association qui documente ses actions pour plus de transparence et d impact.",
            'page_settings' => [
                '/' => ['heroEyebrow' => "Entraide pour servir l'humanite", 'heroTitle' => 'Ensemble pour un impact concret', 'heroDescription' => 'Documenter, informer, mobiliser.', 'heroPrimaryCta' => 'Faire un don', 'heroSecondaryCta' => 'Nos projets'],
                '/about' => ['heroEyebrow' => "Entraide pour servir l'humanite", 'heroTitle' => 'Ensemble pour un impact concret', 'heroDescription' => 'Documenter, informer, mobiliser.', 'heroPrimaryCta' => 'Faire un don', 'heroSecondaryCta' => 'Nos projets'],
                '/projects' => ['heroEyebrow' => "Entraide pour servir l'humanite", 'heroTitle' => 'Ensemble pour un impact concret', 'heroDescription' => 'Documenter, informer, mobiliser.', 'heroPrimaryCta' => 'Faire un don', 'heroSecondaryCta' => 'Nos projets'],
                '/journal' => ['heroEyebrow' => "Entraide pour servir l'humanite", 'heroTitle' => 'Ensemble pour un impact concret', 'heroDescription' => 'Documenter, informer, mobiliser.', 'heroPrimaryCta' => 'Faire un don', 'heroSecondaryCta' => 'Nos projets'],
                '/gallery' => ['heroEyebrow' => "Entraide pour servir l'humanite", 'heroTitle' => 'Ensemble pour un impact concret', 'heroDescription' => 'Documenter, informer, mobiliser.', 'heroPrimaryCta' => 'Faire un don', 'heroSecondaryCta' => 'Nos projets'],
                '/contact' => ['heroEyebrow' => "Entraide pour servir l'humanite", 'heroTitle' => 'Ensemble pour un impact concret', 'heroDescription' => 'Documenter, informer, mobiliser.', 'heroPrimaryCta' => 'Faire un don', 'heroSecondaryCta' => 'Nos projets'],
            ],
            'page_visibility' => [
                '/' => ['emergencyBanner' => true, 'hero' => true, 'trustBar' => true, 'entryPoints' => true, 'projects' => true, 'mission' => true, 'journal' => true, 'transparency' => true, 'gallery' => true, 'donationCta' => true, 'newsletter' => true, 'footer' => true],
                '/about' => ['emergencyBanner' => true, 'hero' => true, 'trustBar' => true, 'entryPoints' => true, 'projects' => false, 'mission' => true, 'journal' => false, 'transparency' => true, 'gallery' => false, 'donationCta' => true, 'newsletter' => false, 'footer' => true],
                '/projects' => ['emergencyBanner' => false, 'hero' => false, 'trustBar' => false, 'entryPoints' => false, 'projects' => true, 'mission' => false, 'journal' => false, 'transparency' => true, 'gallery' => false, 'donationCta' => false, 'newsletter' => false, 'footer' => true],
                '/journal' => ['emergencyBanner' => false, 'hero' => false, 'trustBar' => false, 'entryPoints' => false, 'projects' => false, 'mission' => false, 'journal' => true, 'transparency' => true, 'gallery' => false, 'donationCta' => false, 'newsletter' => false, 'footer' => true],
                '/gallery' => ['emergencyBanner' => false, 'hero' => false, 'trustBar' => false, 'entryPoints' => false, 'projects' => false, 'mission' => false, 'journal' => false, 'transparency' => true, 'gallery' => true, 'donationCta' => true, 'newsletter' => false, 'footer' => true],
                '/contact' => ['emergencyBanner' => false, 'hero' => false, 'trustBar' => false, 'entryPoints' => false, 'projects' => false, 'mission' => false, 'journal' => false, 'transparency' => true, 'gallery' => false, 'donationCta' => true, 'newsletter' => false, 'footer' => true],
            ],
        ]);
    }
}
