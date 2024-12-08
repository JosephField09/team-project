<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Define the best sellers manually with updated prices and ratings
        $bestSellers = [
            (object)[
                'id' => 1, // Add an id property
                'name' => 'Cappuccino',
                'image' => 'cappuccino.jpeg',
                'price' => '£12.00',
                'description' => 'A rich, creamy coffee with steamed milk and foam.',
                'rating' => 5
            ],
            (object)[
                'id' => 2, // Add an id property
                'name' => 'Espresso',
                'image' => 'espresso.jpeg',
                'price' => '£12.00',
                'description' => 'A strong and bold coffee shot.',
                'rating' => 5
            ],
            (object)[
                'id' => 3, // Add an id property
                'name' => 'Macchiato',
                'image' => 'macchiato.jpeg',
                'price' => '£12.00',
                'description' => 'An espresso with a touch of foamed milk.',
                'rating' => 5
            ],
            (object)[
                'id' => 4, // Add an id property
                'name' => 'Hot Chocolate',
                'image' => 'hot_chocolate.jpeg',
                'price' => '£12.00',
                'description' => 'A warm and comforting drink made with rich chocolate.',
                'rating' => 5
            ],
            (object)[
                'id' => 5, // Add an id property
                'name' => 'Americano',
                'image' => 'americano.jpeg',
                'price' => '£12.00',
                'description' => 'A classic coffee made by diluting espresso with hot water.',
                'rating' => 5
            ]
        ];

        return view('home', compact('bestSellers'));
    }
}