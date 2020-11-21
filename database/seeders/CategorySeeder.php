<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Terror";
        $category->description = "El horror o terror es un género literario que se define por la sensación que causa: miedo. ";
        $category->save();

        $category = new Category();
        $category->name = "Romance";
        $category->description = "Relato extenso de ficción, normalmente en prosa, que se diferencia de la novela moderna porque presenta un mundo imaginario en el que los personajes y situaciones pertenecen a la esfera de lo maravilloso y lo insólito.";
        $category->save();

        $category = new Category();
        $category->name = "Ciencia ficción";
        $category->description = "Ciencia ficción es la denominación de uno de los géneros derivados de la literatura de ficción, junto con la literatura fantástica y la narrativa de terror. ";
        $category->save();

        $category = new Category();
        $category->name = "Aventura";
        $category->description = "La novela de aventuras es un género narrativo literario que narra los viajes, el misterio y el riesgo.";
        $category->save();
    }
}
