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
                'emergencyLabel' => "Urgence Sahel",
                'emergencyText' => "Plus de 2 000 familles affectees par la secheresse au Senegal et au Niger. Nos equipes sont mobilisees pour l'acces a l'eau et l'aide alimentaire d'urgence.",
                'heroEyebrow' => "ENTRAIDE POUR SERVIR L'HUMANITE | Agir, documenter, transformer",
                'heroTitle' => "L'eau, l'education et la sante pour les communautes qui en ont le plus besoin.",
                'heroDescription' => "Depuis 2018, nous menons des projets concrets au Senegal et au Niger : forages solaires, distributions alimentaires, soutien scolaire et campagnes de sante preventive. Chaque action est documentee, chaque don est trace.",
                'primaryCta' => "Soutenir un projet",
                'secondaryCta' => "Decouvrir nos actions",
                'heroStats' => [
                    ['value' => '25', 'label' => 'Projets realises'],
                    ['value' => '1 000+', 'label' => 'Familles accompagnees'],
                    ['value' => '2', 'label' => "Pays d'intervention"],
                ],
                'trustPoints' => [
                    "25 projets realises depuis 2018 au Senegal et au Niger",
                    "Plus de 1 000 familles beneficiaires suivies chaque mois",
                    "Forages, cantines scolaires, distributions et soins : des actions visibles et verifiables",
                ],
                'featuredLabel' => "Action en cours",
                'featuredTitle' => "Forage solaire a Nguekokh : 450 familles ont desormais acces a l'eau potable.",
                'featuredDescription' => "Ce projet, finance par nos donateurs, a permis d'installer un forage solaire dans un village qui n'avait pas d'acces a l'eau potable depuis 2019. Les travaux ont ete suivis par notre equipe terrain.",
                'heroImage' => '/assets/banner.jpeg',
                'supportImage' => '/assets/consultation.jpeg',
                'proofStrip' => [
                    ['value' => '2018', 'label' => 'Association fondee'],
                    ['value' => '2021', 'label' => 'Reconnaissance officielle'],
                    ['value' => 'Senegal + Niger', 'label' => "Zones d'action"],
                    ['value' => '25 projets', 'label' => 'Realises et documentes'],
                ],
                'entryPoints' => [
                    ['title' => 'Explorer les projets', 'description' => 'Forages, cantines scolaires, distributions et campagnes de sante : chaque projet est detaille avec photos, objectifs et progression.', 'image' => '/assets/puits.jpeg', 'cta' => 'Decouvrir les projets', 'href' => '/projects'],
                    ['title' => 'Suivre le journal', 'description' => "Actualites du terrain, mises a jour des projets et reportages photo : tout ce qui se passe la ou nous intervenons.", 'image' => '/assets/consultation.jpeg', 'cta' => 'Ouvrir le journal', 'href' => '/journal'],
                    ['title' => 'Voir la galerie', 'description' => "Des images fortes pour voir l'impact de chaque action : scenes de terrain, beneficiaires, realisations.", 'image' => '/assets/about.jpeg', 'cta' => 'Explorer la galerie', 'href' => '/gallery'],
                ],
                'pillars' => [
                    ['title' => "Acces a l'eau et a l'assainissement", 'description' => "Forages solaires, puits, latrines et formation a l'hygiene pour les villages isoles du Senegal et du Niger."],
                    ['title' => 'Education et soutien scolaire', 'description' => "Kits scolaires, cantines, salles de classe et accompagnement des eleves pour lutter contre le decrochage."],
                    ['title' => 'Sante communautaire et prevention', 'description' => "Consultations gratuites, campagnes de sensibilisation, distribution de moustiquaires et appui aux postes de sante locaux."],
                ],
                'transparencyTitle' => "Chaque action est documentee, chaque don est trace",
                'transparencyDescription' => "Projets detailles avec photos, objectifs chiffres et suivi de progression. Journal de terrain pour les mises a jour. Galerie pour les preuves visuelles. Le site est concu pour que chaque visiteur puisse voir exactement ce qui est fait et ou va chaque contribution.",
                'transparencyItems' => [
                    ['value' => 'Journal', 'label' => 'Actualites et mises a jour terrain'],
                    ['value' => 'Galerie', 'label' => 'Photos et videos des realisations'],
                    ['value' => 'Projets', 'label' => 'Fiches detaillees avec suivi financier'],
                    ['value' => 'Impact', 'label' => 'Beneficiaires, chiffres et temoignages'],
                ],
                'galleryTitle' => "Voir l'impact sur le terrain",
                'galleryDescription' => "Forages, distributions, consultations et salles de classe : des images pour temoigner de chaque action menee.",
                'donationHeading' => "Agir maintenant",
                'donationTitle' => "Soutenez nos actions, visibles et documentees sur le terrain.",
                'donationDescription' => "Chaque don est connecte a des projets concrets, avec un suivi visuel et des mises a jour regulieres. Les fonds sont affectes aux actions en cours et aux priorites terrain identifiees par nos equipes.",
                'donationPrimaryCta' => "Faire un don",
                'donationSecondaryCta' => "Voir les projets",
                'newsletterTitle' => "Suivez notre action",
                'newsletterDescription' => "Recevez chaque mois les mises a jour des projets, les nouvelles du terrain et les besoins urgents. Pas de spam, juste de l'impact.",
                'testimonials' => [
                    ['name' => 'Aminata Ndiaye', 'location' => 'Nguekokh, Senegal', 'text' => "Avant le forage, nous marchions 6 kilometres pour trouver de l'eau. Aujourd'hui, nos enfants peuvent aller a l'ecole au lieu de passer leur journee a chercher de l'eau.", 'role' => 'Mere de famille, beneficiaire du forage solaire'],
                    ['name' => 'Dr. Mamadou Fall', 'location' => 'Mbour, Senegal', 'text' => 'Les campagnes de sante organisees par l\'association nous ont permis de toucher plus de 500 familles qui n\'avaient jamais eu acces a une consultation preventive.', 'role' => 'Medecin partenaire'],
                    ['name' => 'Coumba Sy', 'location' => 'Thies, Senegal', 'text' => "Mes trois enfants recoivent des kits scolaires chaque rentree. Sans ce soutien, ils n'auraient pas pu continuer l'ecole apres le CM2.", 'role' => 'Beneficiaire du programme education'],
                ],
            ],
            'about' => [
                'heroEyebrow' => "Qui nous sommes",
                'heroTitle' => "Une association de terrain, ancree au Senegal et au Niger.",
                'heroDescription' => "ENTRAIDE POUR SERVIR L'HUMANITE est une association reconnue qui intervient dans l'acces a l'eau, l'education, la sante et la securite alimentaire. Chaque projet est monte avec les communautes, finance par des dons traces et suivi par une equipe de terrain.",
                'stats' => [
                    ['value' => '2018', 'label' => 'Creation'],
                    ['value' => '2021', 'label' => 'Reconnaissance officielle'],
                    ['value' => '2', 'label' => "Pays d'intervention"],
                ],
                'associationBadge' => "Notre histoire",
                'associationTitle' => "Une equipe dediee a l'impact social et a la transparence",
                'associationBody' => [
                    "Fondee le 12 mars 2018 et reconnue officiellement par le Ministere de l'Interieur du Senegal le 2 avril 2021, l'association s'est donne pour mission de structurer des actions humanitaires durables dans les zones les plus isolees.",
                    "Nos programmes couvrent quatre axes : l'acces a l'eau potable (forages solaires, puits), l'education (kits scolaires, cantines, salles de classe), la sante (consultations, prevention, moustiquaires) et la securite alimentaire (distributions, banques cerealieres).",
                    "A ce jour, 25 projets ont ete realises au Senegal et au Niger, touchant directement plus de 1 000 familles. Chaque intervention fait l'objet d'un suivi documente avec photos, temoignages et bilans chiffres.",
                ],
                'associationImage' => '/assets/about.jpeg',
                'portrait' => '/assets/about.jpeg',
                'story' => [
                    "ENTRAIDE POUR SERVIR L'HUMANITE est une organisation de terrain qui agit pour repondre a des besoins concrets : l'eau, l'ecole, les soins et de quoi se nourrir. Chaque projet est le resultat d'une demande des communautes et d'une etude de faisabilite menee par notre equipe.",
                    "Notre modele repose sur la transparence : chaque don est affecte a un projet specifique, suivi avec des indicateurs clairs et documente par des photos et des temoignages. Les donateurs recoivent un bilan regulier de l'avancement des actions qu'ils soutiennent.",
                    "Nous travaillons avec des partenaires locaux, des relais communautaires et des benevoles pour maximiser l'impact de chaque intervention et garantir une presence continue sur le terrain.",
                ],
                'founderBadge' => "Fondateur",
                'founderTitle' => "Un engagement ne d'une conviction : servir la ou les besoins sont les plus urgents.",
                'founderSubtitle' => "Le fondateur a choisi de consacrer son experience aux communautes les plus isolees du Senegal et du Niger.",
                'founderPortrait' => '/assets/partenaire.jpeg',
                'founderQuote' => "Nous ne faisons pas de promesses que nous ne pouvons pas tenir. Chaque projet est concu avec les beneficiaires, finance de maniere transparente et suivi jusqu'a son terme.",
                'narrativeTitle' => "Un engagement qui se mesure sur le terrain",
                'narrativeParagraphs' => [
                    "La force de notre association repose sur une conviction simple : l'aide humanitaire doit etre visible et accountable. Chaque projet est documente de A a Z, chaque depense est justifiee, chaque resultat est publie.",
                    "Le fondateur a porte cette vision depuis le premier jour : une structure legere, des couts de fonctionnement reduits, et l'essentiel des ressources consacrees aux actions terrain.",
                    "L'objectif est clair : continuer a developper nos programmes existants, former davantage de relais locaux et ouvrir de nouveaux projets la ou les besoins sont les plus critiques.",
                ],
                'values' => [
                    ['title' => 'Solidarite', 'description' => "Agir ensemble pour repondre aux besoins fondamentaux des communautes les plus vulnerables. En 2025, nous avons distribue 12 tonnes de riz, 3 000 kits scolaires et finance 450 consultations medicales."],
                    ['title' => 'Dignite', 'description' => "Chaque personne, chaque famille est traitee avec respect. Nos programmes sont concus avec les communautes, pas imposes. Les beneficiaires sont associes a chaque etape des projets."],
                    ['title' => 'Transparence', 'description' => "Tous nos projets sont documentes avec des photos, des chiffres et des temoignages. Les bilans financiers sont publies, les donateurs recoivent un suivi regulier de l'impact de leurs dons."],
                    ['title' => 'Ancrage local', 'description' => "Nous travaillons avec des partenaires locaux, des relais communautaires et des benevoles senegalais et nigeriens. C'est la meilleure garantie d'une action adaptee et durable."],
                ],
                'timeline' => [
                    ['year' => '2018', 'title' => 'Fondation', 'text' => "Creation de l'association avec la volonte de structurer des actions humanitaires durables au Senegal. Premiere campagne de distribution alimentaire a Mbour."],
                    ['year' => '2019', 'title' => 'Premier forage solaire', 'text' => "Installation d'un premier forage solaire a Nguekokh, permettant a 450 familles d'acceder a l'eau potable. Lancement du programme education avec 200 kits scolaires distribues."],
                    ['year' => '2021', 'title' => 'Reconnaissance officielle', 'text' => "Reconnaissance par le Ministere de l'Interieur du Senegal. Obtention du recu fiscal. Debut de l'expansion des programmes au-dela de la region de Thies."],
                    ['year' => '2023', 'title' => 'Ouverture au Niger', 'text' => "Premieres interventions au Niger avec un programme de securite alimentaire et d'acces a l'eau. L'association franchit le cap des 20 projets realises."],
                    ['year' => "Aujourd'hui", 'title' => '25 projets et 1 000 familles touchees', 'text' => "L'association continue de grandir avec des programmes structures, un suivi documente et une equipe de terrain renforcee."],
                ],
                'actionStories' => [
                    ['title' => 'Forage solaire a Nguekokh', 'text' => "Le village de Nguekokh n'avait pas d'acces a l'eau potable depuis 2019. Grace au soutien de nos donateurs, un forage solaire a ete installe. Aujourd'hui, les femmes ne marchent plus 6 km pour chercher de l'eau.", 'image' => '/assets/puits.jpeg'],
                    ['title' => 'Cantine scolaire de Thies', 'text' => "La cantine scolaire de Thies permet a 300 enfants de recevoir un repas equilibre chaque jour. Un repas chaud, c'est un enfant qui reste a l'ecole, qui apprend mieux et qui ne tombe pas malade.", 'image' => '/assets/classe.jpeg'],
                    ['title' => 'Consultations gratuites a Mbour', 'text' => "En partenariat avec des medecins locaux, nous organisons chaque trimestre des consultations gratuites dans les quartiers defavorises de Mbour. Depistages, soins de base, distribution de moustiquaires et sensibilisation.", 'image' => '/assets/consultation.jpeg'],
                ],
                'calloutTitle' => "Chaque don a un impact visible et verifiable",
                'calloutDescription' => "Nous nous engageons a vous montrer exactement ce que votre soutien permet de realiser : photos, temoignages, bilans chiffres et suivi des projets en temps reel.",
                'calloutPrimaryCta' => "Voir les projets",
                'calloutSecondaryCta' => "Faire un don",
                'testimonials' => [
                    ['name' => 'Fatou Dieng', 'location' => 'Mbour, Senegal', 'text' => "Avant les consultations gratuites, je n'avais jamais pu faire examiner mes enfants. Maintenant je sais qu'ils sont en bonne sante et je peux dormir tranquille.", 'role' => 'Mere de 4 enfants'],
                    ['name' => 'Ibrahima Sow', 'location' => 'Thies, Senegal', 'text' => "Mon fils a recu un kit scolaire l'annee derniere. Ca parait rien mais sans ca, il n'aurait pas pu commencer l'annee. Ca change tout pour nous.", 'role' => 'Parent d\'eleve'],
                ],
            ],
            'contact' => [
                'heroEyewbrow' => 'Contact',
                'heroTitle' => "Une question ? Un projet a proposer ? Ecrivez-nous.",
                'heroDescription' => "Vous pouvez nous joindre par formulaire, par email ou par telephone. Nous repondons sous 24 a 48 heures ouvreEs.",
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
                    ['title' => "Ecrire a l'association", 'text' => "Pour toute question, proposition ou demande d'information, utilisez le formulaire ci-contre ou ecrivez-nous directement par email. Nous repondons sous 24 a 48 heures ouvreEs."],
                    ['title' => "Suivre un projet", 'text' => "Vous avez deja soutenu un projet et souhaitez un suivi personnalise ? Indiquez le nom du projet dans votre message, nous vous enverrons un bilan detaille."],
                    ['title' => "Presse et partenariats", 'text' => "Journalistes, partenaires potentiels, chercheurs : contactez-nous pour toute demande editoriale ou de collaboration."],
                ],
                'faq' => [
                    ['question' => "Comment sont utilises les dons ?", 'answer' => "Chaque don est affecte a un projet specifique. Vous recevez un bilan regulier avec photos et chiffres. Les frais de fonctionnement sont limites au strict necessaire pour maximiser l'impact terrain."],
                    ['question' => "Puis-je parrainer un projet ?", 'answer' => "Vous pouvez soutenir un projet en particulier (forage, cantine scolaire, campagne medicale) et recevoir un suivi personnalise de son avancement. Contactez-nous pour en discuter."],
                    ['question' => "Comment suivre l'avancement des projets ?", 'answer' => "Chaque projet a sa page dediee avec objectifs, photos et pourcentage de realisation. Le journal de terrain publie des mises a jour regulieres. Les donateurs recoivent un rapport trimestriel."],
                ],
                'faqHeading' => "Questions frequentes",
                'faqTitle' => "Reponses aux demandes les plus courantes pour vous orienter rapidement.",
            ],
        ];

        foreach ($pages as $slug => $content) {
            PageContent::updateOrCreate(
                ['page_slug' => $slug],
                ['content' => $content, 'published_at' => now()]
            );
        }
    }
}
