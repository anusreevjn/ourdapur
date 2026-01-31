<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a fake "Chef" user if one doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'chef@ourdapur.com'],
            [
                'name' => 'Chef Adam',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Create delicious recipes
        $recipes = [
            [
                'title' => 'Classic Nasi Lemak',
                'description' => 'Fragrant rice cooked in coconut milk and pandan leaf, served with spicy sambal, crispy anchovies, toasted peanuts, and cucumber.',
                'ingredients' => "2 cups rice\n1 cup coconut milk\n3 pandan leaves\n1 cucumber\n1 cup dried anchovies\nSambal paste",
                'instructions' => "1. Wash rice and cook with coconut milk and pandan leaves.\n2. Fry anchovies until crispy.\n3. Slice cucumber.\n4. Serve rice with generous dollop of sambal.",
                'cuisine' => 'Malaysian',
                'meal_type' => 'Breakfast',
                'difficulty' => 'Medium',
                'portion_size' => 4,
                'image_url' => 'https://placehold.co/600x400/orange/white?text=Nasi+Lemak', // Placeholder image
            ],
            [
                'title' => 'Chicken Satay with Peanut Sauce',
                'description' => 'Skewered and grilled marinated chicken served with a rich and spicy peanut dipping sauce.',
                'ingredients' => "500g Chicken breast\nLemongrass\nTurmeric powder\nPeanuts\nChili paste\nSugar",
                'instructions' => "1. Marinate chicken cubes with spices for 2 hours.\n2. Skewer the meat.\n3. Grill over charcoal until charred.\n4. Blend peanuts and cook sauce until thick.",
                'cuisine' => 'Malaysian',
                'meal_type' => 'Dinner',
                'difficulty' => 'Medium',
                'portion_size' => 3,
                'image_url' => 'https://placehold.co/600x400/orange/white?text=Satay',
            ],
            [
                'title' => 'Kimchi Fried Rice',
                'description' => 'A popular Korean dish made primarily with kimchi and rice, topped with a sunny-side-up egg.',
                'ingredients' => "2 cups cooked rice\n1 cup kimchi\n1 tbsp gochujang\n1 egg\nSesame oil\nGreen onions",
                'instructions' => "1. Fry chopped kimchi in oil.\n2. Add rice and gochujang, mix well.\n3. Drizzle sesame oil.\n4. Fry an egg and place on top.",
                'cuisine' => 'Korean',
                'meal_type' => 'Lunch',
                'difficulty' => 'Easy',
                'portion_size' => 2,
                'image_url' => 'https://placehold.co/600x400/orange/white?text=Kimchi+Rice',
            ],
            [
                'title' => 'Japanese Souffle Pancakes',
                'description' => 'Fluffy, airy, and delicate pancakes that melt in your mouth.',
                'ingredients' => "2 eggs\n2 tbsp milk\n3 tbsp flour\n2 tbsp sugar\nVanilla extract",
                'instructions' => "1. Separate egg whites and yolks.\n2. Mix yolks with milk and flour.\n3. Whip whites with sugar until stiff peaks form.\n4. Fold together and cook on low heat covered.",
                'cuisine' => 'Japanese',
                'meal_type' => 'Dessert',
                'difficulty' => 'Hard',
                'portion_size' => 2,
                'image_url' => 'https://placehold.co/600x400/orange/white?text=Pancakes',
            ],
            [
                'title' => 'Kampung Fried Rice',
                'description' => 'Traditional village-style fried rice with water spinach (kangkung) and anchovies. Spicy and savory!',
                'ingredients' => "3 cups cold rice\n1 bunch kangkung\n2 bird's eye chilies\n1/2 cup anchovies\nGarlic and shallots",
                'instructions' => "1. Pound chilies, garlic, and shallots.\n2. Sauté paste until fragrant.\n3. Add anchovies and kangkung.\n4. Toss in rice and stir-fry on high heat.",
                'cuisine' => 'Malaysian',
                'meal_type' => 'Lunch',
                'difficulty' => 'Easy',
                'portion_size' => 3,
                'image_url' => 'https://placehold.co/600x400/orange/white?text=Nasi+Goreng',
            ]
        ];

        foreach ($recipes as $recipe) {
            Recipe::create(array_merge($recipe, ['user_id' => $user->id]));
        }
    }
}