<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'distribution-alimentaire-mbour',
                'category' => 'terrain', 'read_time' => '4 min',
                'is_published' => true, 'published_at' => '2026-04-29',
                'image' => '/assets/alimentaire.jpeg',
                'title' => ['fr' => 'Distribution alimentaire a Mbour', 'en' => 'Food distribution in Mbour', 'ar' => 'توزيع غذائي في مبور'],
                'excerpt' => ['fr' => "Nouvelle distribution de colis alimentaires dans les quartiers peripheriques de Mbour.", 'en' => 'New food parcel distribution in Mbour outskirts.', 'ar' => 'توزيع جديد للطرود الغذائية في ضواحي مبور.'],
                'content' => ['fr' => "Ce mois-ci, nous avons distribue 350 colis alimentaires dans les quartiers peripheriques de Mbour. Chaque colis comprenait du riz, de l'huile, du sucre, du mil et du lait. Les equipes ont ete deployees des 7h du matin pour assurer un accueil structure et limiter l'attente. Les beneficiaires avaient ete identifies en amont par les relais communautaires locaux.", 'en' => 'This month we distributed 350 food parcels in Mbour. Each parcel included rice, oil, sugar, millet, and milk.', 'ar' => 'قمنا هذا الشهر بتوزيع 350 طرداً غذائياً في ضواحي مبور.'],
                'location' => ['fr' => 'Mbour, Senegal', 'en' => 'Mbour, Senegal', 'ar' => 'مبور، السنغال'],
            ],
            [
                'slug' => 'avancee-forage-kaolack',
                'category' => 'project-update', 'read_time' => '3 min',
                'is_published' => true, 'published_at' => '2026-04-26',
                'image' => '/assets/puits.jpeg',
                'title' => ['fr' => 'Avancee du forage secondaire a Kaolack', 'en' => 'Secondary borehole progress in Kaolack', 'ar' => 'تقدم البئر الثانوي في كاولاك'],
                'excerpt' => ['fr' => "Le forage secondaire de Kaolack atteint 80% de son objectif.", 'en' => 'The Kaolack secondary borehole reaches 80% of its goal.', 'ar' => 'البئر الثانوي في كاولاك يصل إلى 80% من هدفه.'],
                'content' => ['fr' => "Le projet de forage secondaire a Kaolack avance bien. La pompe manuelle a ete installee avec succes et les tests de debit sont concluants. Les premiers retours des habitants sont tres positifs.", 'en' => 'The secondary borehole project in Kaolack is progressing well. The hand pump has been successfully installed.', 'ar' => 'يتقدم مشروع البئر الثانوي في كاولاك بشكل جيد.'],
                'location' => ['fr' => 'Kaolack, Senegal', 'en' => 'Kaolack, Senegal', 'ar' => 'كاولاك، السنغال'],
            ],
            [
                'slug' => 'coordination-sante-communautaire',
                'category' => 'association', 'read_time' => '5 min',
                'is_published' => true, 'published_at' => '2026-04-23',
                'image' => '/assets/about.jpeg',
                'title' => ['fr' => 'Coordination sante communautaire', 'en' => 'Community health coordination', 'ar' => 'تنسيق الصحة المجتمعية'],
                'excerpt' => ['fr' => "Les equipes de coordination sante communautaire font le point.", 'en' => 'Community health coordination teams take stock.', 'ar' => 'فرق تنسيق الصحة المجتمعية تقوم بتقييم الوضع.'],
                'content' => ['fr' => "Reunion de coordination entre les differents acteurs de sante communautaire intervenant dans la region de Thies. Objectif : harmoniser les actions et eviter les doublons sur le terrain.", 'en' => 'Coordination meeting between community health actors in Thies region.', 'ar' => 'اجتماع تنسيقي بين مختلف الفاعلين في الصحة المجتمعية في منطقة ثيس.'],
                'location' => ['fr' => 'Thies, Senegal', 'en' => 'Thies, Senegal', 'ar' => 'ثيس، السنغال'],
            ],
            [
                'slug' => 'carnet-terrain-education-diourbel',
                'category' => 'terrain', 'read_time' => '6 min',
                'is_published' => true, 'published_at' => '2026-04-20',
                'image' => '/assets/educationn.jpeg',
                'title' => ['fr' => 'Carnet de terrain - Education a Diourbel', 'en' => 'Field notes - Education in Diourbel', 'ar' => 'ملاحظات ميدانية - التعليم في ديوربيل'],
                'excerpt' => ['fr' => "Visite des classes soutenues par le programme education dans la region de Diourbel.", 'en' => 'Visit to classes supported by the education program in Diourbel.', 'ar' => 'زيارة الفصول الدراسية المدعومة من برنامج التعليم في منطقة ديوربيل.'],
                'content' => ['fr' => "Les equipes sont allees a la rencontre des enseignants et des eleves dans les ecoles soutenues par le programme education a Diourbel. Les kits scolaires distribues en debut d'annee sont bien utilises et les cours de soutien commencent a montrer des resultats.", 'en' => 'Teams visited teachers and students in education program schools in Diourbel.', 'ar' => 'زارت الفرق المعلمين والطلاب في المدارس المدعومة من برنامج التعليم في ديوربيل.'],
                'location' => ['fr' => 'Diourbel, Senegal', 'en' => 'Diourbel, Senegal', 'ar' => 'ديوربيل، السنغال'],
            ],
            [
                'slug' => 'preparation-tabaski-solidaire',
                'category' => 'project-update', 'read_time' => '3 min',
                'is_published' => true, 'published_at' => '2026-04-16',
                'image' => '/assets/bouffe.jpeg',
                'title' => ['fr' => 'Preparation de la Tabaski solidaire', 'en' => 'Preparing the solidarity Tabaski', 'ar' => 'التحضير لأضحية التضامن'],
                'excerpt' => ['fr' => "Les preparatifs pour la Tabaski solidaire 2026 sont en cours.", 'en' => 'Preparations for the Solidarity Tabaski 2026 are underway.', 'ar' => 'التحضيرات لأضحية التضامن 2026 جارية.'],
                'content' => ['fr' => "Les equipes sont mobilisees pour organiser la collecte et la distribution de viande pour la Tabaski 2026. Cette annee, nous visons 400 familles beneficiaires.", 'en' => 'Teams are mobilized to organize the meat distribution for Tabaski 2026.', 'ar' => 'الفرق معبأة لتنظيم توزيع اللحوم لعيد الأضحى 2026.'],
                'location' => ['fr' => 'Mbour, Senegal', 'en' => 'Mbour, Senegal', 'ar' => 'مبور، السنغال'],
            ],
            [
                'slug' => 'partenariats-locaux-sante',
                'category' => 'association', 'read_time' => '4 min',
                'is_published' => true, 'published_at' => '2026-04-13',
                'image' => '/assets/about.jpeg',
                'title' => ['fr' => 'Partenariats locaux pour la sante', 'en' => 'Local health partnerships', 'ar' => 'شراكات محلية للصحة'],
                'excerpt' => ['fr' => "Signature de nouvelles conventions avec des structures de sante locales.", 'en' => 'New agreements signed with local health facilities.', 'ar' => 'توقيع اتفاقيات جديدة مع مرافق صحية محلية.'],
                'content' => ['fr' => "Nous avons signe des conventions avec trois centres de sante dans la region de Mbour pour renforcer l'acces aux soins des populations vulnerables.", 'en' => 'Agreements signed with three health centers in Mbour region.', 'ar' => 'وقعنا اتفاقيات مع ثلاثة مراكز صحية في منطقة مبور.'],
                'location' => ['fr' => 'Mbour, Senegal', 'en' => 'Mbour, Senegal', 'ar' => 'مبور، السنغال'],
            ],
            [
                'slug' => 'mission-niger-suivi-communautaire',
                'category' => 'terrain', 'read_time' => '7 min',
                'is_published' => true, 'published_at' => '2026-04-10',
                'image' => '/assets/consultation.jpeg',
                'title' => ['fr' => 'Mission Niger - Suivi communautaire', 'en' => 'Niger mission - Community follow-up', 'ar' => 'بعثة النيجر - متابعة مجتمعية'],
                'excerpt' => ['fr' => "Mission de suivi des programmes dans la region de Maradi au Niger.", 'en' => 'Follow-up mission for programs in Maradi, Niger.', 'ar' => 'بعثة متابعة للبرامج في منطقة مارادي بالنيجر.'],
                'content' => ['fr' => "Une mission de suivi a ete organisee dans la region de Maradi pour evaluer l'impact des programmes en cours et identifier les besoins prioritaires.", 'en' => 'A follow-up mission was organized in Maradi to assess program impact.', 'ar' => 'تم تنظيم بعثة متابعة في منطقة مارادي لتقييم أثر البرامج الجارية.'],
                'location' => ['fr' => 'Maradi, Niger', 'en' => 'Maradi, Niger', 'ar' => 'مارادي، النيجر'],
            ],
            [
                'slug' => 'ligne-editoriale-transparence-terrain',
                'category' => 'association', 'read_time' => '5 min',
                'is_published' => true, 'published_at' => '2026-04-07',
                'image' => '/assets/logement.jpeg',
                'title' => ['fr' => 'Ligne editoriale - transparence et terrain', 'en' => 'Editorial line - transparency and field', 'ar' => 'الخط التحريري - الشفافية والميدان'],
                'excerpt' => ['fr' => "Notre engagement pour une communication transparente et ancree dans le reel.", 'en' => 'Our commitment to transparent and reality-based communication.', 'ar' => 'التزامنا بالتواصل الشفاف والقائم على الواقع.'],
                'content' => ['fr' => "Nous faisons le choix d'une ligne editoriale axee sur la transparence et les preuves de terrain. Chaque article, chaque photo est verifie et contextualise.", 'en' => 'We choose an editorial line focused on transparency and field evidence.', 'ar' => 'نختار خطاً تحريرياً يركز على الشفافية والأدلة الميدانية.'],
                'location' => ['fr' => 'Senegal', 'en' => 'Senegal', 'ar' => 'السنغال'],
            ],
        ];

        foreach ($posts as $data) {
            Post::create($data);
        }
    }
}
