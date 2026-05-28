<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => [
                'emergencyLabel' => "A la une",
                'emergencyText' => "Des actions de terrain sont en cours au Senegal et au Niger. Suivez les projets prioritaires, les mises a jour et les besoins urgents.",
                'heroEyebrow' => "Association humanitaire | Projets, journal et impact",
                'heroTitle' => "Montrer l'action humanitaire avec des images, des projets et des preuves de terrain.",
                'heroDescription' => "ENTRAIDE POUR SERVIR L'HUMANITE documente ses interventions, publie des nouvelles utiles et rend chaque projet plus lisible pour le public, les partenaires et les donateurs.",
                'primaryCta' => "Faire un don",
                'secondaryCta' => "Voir les projets",
                'heroStats' => [
                    ['value' => '25', 'label' => 'Projets accompagnes'],
                    ['value' => '1000+', 'label' => 'Beneficiaires suivis'],
                    ['value' => '2', 'label' => "Pays d'intervention"],
                ],
                'trustPoints' => [
                    "Actions documentees sur le terrain",
                    "Mises a jour editoriales regulieres",
                    "Priorite aux projets utiles et verifiables",
                ],
                'featuredLabel' => "Urgence terrain",
                'featuredTitle' => "Chaque visite doit montrer tout de suite ce qui est fait, ou, pour qui et pourquoi.",
                'featuredDescription' => "Le site met l'accent sur la clarte, les preuves visuelles et le suivi des projets pour inspirer confiance des la premiere visite.",
                'heroImage' => '/assets/banner.jpeg',
                'supportImage' => '/assets/consultation.jpeg',
                'proofStrip' => [
                    ['value' => '2018', 'label' => 'Association fondee'],
                    ['value' => '2021', 'label' => 'Reconnaissance officielle'],
                    ['value' => 'Senegal + Niger', 'label' => "Zones d'action"],
                    ['value' => 'Images + journal', 'label' => 'Communication terrain'],
                ],
                'entryPoints' => [
                    ['title' => 'Explorer les projets', 'description' => 'Voir les actions en cours, les besoins, la progression et les pages detaillees.', 'image' => '/assets/puits.jpeg', 'cta' => 'Ouvrir les projets', 'href' => '/projects'],
                    ['title' => 'Lire le journal', 'description' => 'Suivre les nouvelles du terrain, les comptes rendus et les mises a jour utiles.', 'image' => '/assets/consultation.jpeg', 'cta' => 'Ouvrir le journal', 'href' => '/journal'],
                    ['title' => 'Voir la galerie', 'description' => "Entrer dans l'action par l'image avec des scenes de terrain et des interventions visibles.", 'image' => '/assets/about.jpeg', 'cta' => 'Ouvrir la galerie', 'href' => '/gallery'],
                ],
                'pillars' => [
                    ['title' => 'Ce que nous faisons', 'description' => "Des projets concrets autour de l'eau, de la sante, de l'education et de l'appui communautaire."],
                    ['title' => 'Comment nous racontons le terrain', 'description' => "Un journal d'actualites, de mises a jour projets et de comptes rendus pour garder une trace utile."],
                    ['title' => 'Pourquoi nous inspirer confiance', 'description' => 'Des chiffres simples, des galeries de terrain et une presentation claire des priorites et des avances.'],
                ],
                'transparencyTitle' => "Un site pense comme une base de suivi",
                'transparencyDescription' => "Le front est structure pour montrer les projets, publier les nouvelles importantes et rendre les actions plus lisibles avant le branchement Laravel.",
                'transparencyItems' => [
                    ['value' => 'Journal', 'label' => 'Actualites et mises a jour'],
                    ['value' => 'Galerie', 'label' => 'Photos et traces du terrain'],
                    ['value' => 'Projets', 'label' => 'Pages detaillees et progression'],
                    ['value' => 'Don', 'label' => "Points d'entree clairs et visibles"],
                ],
                'galleryTitle' => "Voir le terrain",
                'galleryDescription' => "Des visuels forts pour montrer les projets, les actions en cours et les contextes d'intervention.",
                'donationHeading' => "Agir maintenant",
                'donationTitle' => "Soutenez nos actions, visibles et documentees sur le terrain.",
                'donationDescription' => "Chaque don est connecte a des projets concrets, avec un suivi visuel et des mises a jour regulieres. Les fonds sont affectes aux actions en cours et aux priorites terrain identifiees par nos equipes.",
                'donationPrimaryCta' => "Faire un don",
                'donationSecondaryCta' => "Voir les projets",
                'newsletterTitle' => "Recevoir les actualites",
                'newsletterDescription' => "Inscrivez-vous pour suivre les mises a jour des projets, les nouvelles publications et les priorites du moment.",
            ],
            'about' => [
                'heroEyebrow' => "A propos",
                'heroTitle' => "Une association qui documente ses actions, raconte le terrain et prepare chaque projet avec rigueur.",
                'heroDescription' => "De la creation a la reconnaissance officielle, le chemin parcouru montre une volonte constante de structurer l'action et de la rendre visible.",
                'stats' => [
                    ['value' => '2018', 'label' => 'Creation'],
                    ['value' => '2021', 'label' => 'Reconnaissance officielle'],
                    ['value' => '2', 'label' => "Pays d'intervention"],
                ],
                'associationBadge' => "L'association",
                'associationTitle' => "Une equipe dediee a l'impact social et a la transparence",
                'associationBody' => [
                    "ENTRAIDE POUR SERVIR L'HUMANITE est nee de la volonte de repondre aux besoins urgents des communautes vulnerables, avec une approche axee sur la dignite, la collaboration et l'impact mesurable.",
                    "Reconnue officiellement en 2021, l'association a depuis multiplie les initiatives dans les domaines de l'eau, de la sante, de l'education et de la securite alimentaire.",
                    "Aujourd'hui, elle intervient au Senegal et au Niger, en travaillant avec des partenaires locaux et des relais communautaires pour maximiser l'efficacite de chaque action.",
                ],
                'associationImage' => '/assets/about.jpeg',
                'portrait' => '/assets/banner.jpeg',
                'story' => [
                    "L'histoire commence par un constat simple : des besoins urgents et peu de visibilite pour les actions de terrain.",
                    "Chaque projet est monte avec les communautes, suivi avec des indicateurs clairs et documente pour garantir la transparence.",
                    "L'objectif est de construire un modele reproductible, ou chaque don et chaque action ont un impact visible et verifiable.",
                ],
                'founderBadge' => "Fondateur",
                'founderTitle' => "Porter une vision, construire des ponts",
                'founderSubtitle' => 'M. X',
                'founderPortrait' => '/assets/banner.jpeg',
                'founderQuote' => "Notre force, c'est la transparence. Chaque action doit pouvoir etre montree, expliquee et comprise.",
                'narrativeTitle' => "Une vision ancree dans le reel",
                'narrativeParagraphs' => [
                    "Loin des discours, l'association mise sur des realisations tangibles et une communication claire.",
                    "Les projets sont selectionnes selon leur impact potentiel et leur faisabilite terrain.",
                    "L'equipe s'appuie sur un reseau de benevoles et de partenaires locaux pour assurer une presence continue.",
                ],
                'values' => [
                    ['title' => 'Solidarite', 'description' => "Agir ensemble pour repondre aux besoins fondamentaux des communautes les plus vulnerables, sans discrimination."],
                    ['title' => 'Dignite', 'description' => "Respecter chaque personne dans sa singularite et sa culture, en plaçant l'humain au coeur de chaque projet."],
                    ['title' => 'Transparence', 'description' => "Documenter chaque action, publier les resultats et rendre compte pour maintenir la confiance des donateurs et partenaires."],
                    ['title' => 'Ancrage local', 'description' => "Travailler avec les acteurs locaux, respecter les contextes et favoriser l'autonomie des communautes."],
                ],
                'timeline' => [
                    ['year' => '2018', 'title' => 'Creation', 'text' => "L'association est fondee avec la volonte de structurer des actions humanitaires durables."],
                    ['year' => '2021', 'title' => 'Reconnaissance officielle', 'text' => "Obtention du recu fiscal et reconnaissance officielle permettant de deployer les programmes a plus grande echelle."],
                    ['year' => "Aujourd'hui", 'title' => 'Structuration et impact', 'text' => "L'association se structure avec des programmes clairs, un suivi documente et une communication transparente."],
                ],
                'actionStories' => [
                    ['title' => 'Forage solaire', 'text' => "Un forage solaire a permis a 450 familles d'acceder a l'eau potable a Nguekokh.", 'image' => '/assets/puits.jpeg'],
                    ['title' => 'Education pour tous', 'text' => 'Distribution de kits scolaires et soutien educatif pour 300 enfants a Thies.', 'image' => '/assets/educationn.jpeg'],
                    ['title' => 'Sante preventive', 'text' => 'Consultations gratuites et campagnes de sensibilisation a Mbour.', 'image' => '/assets/consultation.jpeg'],
                ],
                'calloutTitle' => "Pret a nous soutenir ?",
                'calloutDescription' => "Chaque action compte. Decouvrez nos projets, suivez nos actions et contribuez a un impact durable et visible.",
                'calloutPrimaryCta' => "Voir les projets",
                'calloutSecondaryCta' => "Faire un don",
            ],
            'contact' => [
                'heroEyewbrow' => 'Contact',
                'heroTitle' => "Une page contact qui reduit les frictions et donne confiance.",
                'heroDescription' => "Remplir un formulaire, ecrire directement ou trouver l'information utile : chaque point de contact doit etre clair, fonctionnel et rassurant.",
                'contactHeading' => "Parler a l'association",
                'address' => "Medine N 260, Mbour, Senegal",
                'phones' => ["+221 77 639 20 69", "+221 76 811 14 12"],
                'emails' => ["toleye2@gmail.com", "eapsh1@outlook.com"],
                'presseTitle' => "Presse / Journal",
                'presseText' => "Pour les demandes autour des actualites, des publications et de la communication.",
                'projetsTitle' => "Projets",
                'projetsText' => "Pour parler d'un projet, d'une priorite terrain ou d'un besoin d'information detaille.",
                'formTitle' => "Envoyer un message",
                'formFields' => [
                    ['label' => "Prenom", 'type' => "text"],
                    ['label' => "Nom", 'type' => "text"],
                    ['label' => "Email", 'type' => "email"],
                    ['label' => "Votre message", 'type' => "textarea"],
                ],
                'subjectOptions' => ["Choisir un sujet", "Projet", "Journal", "Don", "Partenariat"],
                'submitCta' => "Envoyer",
                'successMessage' => "Merci pour votre message. Nous vous repondrons dans les plus brefs delais.",
                'contactCards' => [
                    ['title' => "Ecrire a l'association", 'text' => "Une question, un message ou une proposition, utilisez le formulaire pour nous joindre facilement."],
                    ['title' => "Suivre un projet", 'text' => "Vous pouvez aussi ecrire directement a propos d'un projet specifique en utilisant le champ objet."],
                    ['title' => "Presse et journal", 'text' => "Les demandes presse et les propositions de collaboration editoriale sont les bienvenues."],
                ],
                'faq' => [
                    ['question' => "Quels sont les delais de reponse ?", 'answer' => "Nous repondons generalement sous 24 a 48 heures ouvrées."],
                    ['question' => "Puis-je proposer un projet ?", 'answer' => "Oui, vous pouvez nous ecrire directement avec votre proposition. Nous etudions toutes les initiatives."],
                    ['question' => "Comment sont utilises les dons ?", 'answer' => "Les dons sont affectes aux projets en cours et aux priorites terrain, avec un suivi transparent."],
                ],
                'faqHeading' => "Questions frequentes",
                'faqTitle' => "Reponses aux demandes les plus courantes pour vous orienter rapidement.",
            ],
        ];

        foreach ($pages as $slug => $content) {
            PageContent::create([
                'page_slug' => $slug,
                'content' => $content,
                'published_at' => now(),
            ]);
        }
    }
}
