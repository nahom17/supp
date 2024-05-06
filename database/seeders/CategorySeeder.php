<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{

    public function run()
    { {
            Category::updateOrCreate([
                'id' => 1,
                'name' => 'Sport',
                'description' => 'Een sport kan omschreven worden als een fysieke krachtmeting (bijvoorbeeld zwemmen), fysiek spel (bijvoorbeeld voetbal) of denkspel (bijvoorbeeld schaken) dat op reglementaire wijze in competitieverband of recreatief gespeeld kan worden.'
            ]);

            Category::updateOrCreate([
                'id' => 2,
                'name' => 'Tech',
                'description' => 'Tech is een afkorting voor technisch of technologisch: gebruikt om een bedrijf, systeem, werkgebied, enz. te beschrijven dat iets doet of maakt waarbij technologie betrokken is.'
            ]);
            Category::updateOrCreate([
                'id' => 3,
                'name' => 'Economie',
                'description' => 'Economie is een wetenschap die zich bezighoudt met de keuzes die mensen maken bij de productie, distributie en consumptie van goederen en diensten. Daarbij wordt onderscheid gemaakt tussen macro-economie, waar vragen naar voren komen over de nationale en wereldwijde economie, zoals werkloosheid, inflatie en rentestanden, meso-economie en micro-economie, over het gedrag van bedrijven en consumenten.'
            ]);
        }
    }
}
