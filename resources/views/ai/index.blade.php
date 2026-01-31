<x-layout>
    <style>
        /* 1. Override the global hero-section width restriction (was 800px) */
        .hero-section {
            max-width: 1400px !important; /* Allow it to be wide enough for 4 columns */
            width: 100%;
            margin: 0 auto;
            padding: 4rem 1rem;
        }

        /* 2. Ensure the container fills the new wide hero section */
        .hero-section .container {
            max-width: 100% !important;
            padding: 0 1rem;
        }

        /* 3. The Card: Use fit-content so the white background stretches if text is long */
        .ingredient-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            padding: 2rem;
            margin: 0 auto;
            text-align: left;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            
            /* Key fix: Adjust width based on content, but min-width of 100% of parent */
            width: fit-content;
            min-width: 100%;
            box-sizing: border-box; /* Ensure padding doesn't break width */
        }

        /* 4. The Grid */
        .ingredients-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 Columns */
            gap: 1rem 2rem; /* Row Gap: 1rem, Col Gap: 2rem (extra space for text) */
            margin-bottom: 2rem;
        }

        /* 5. Checkbox Items */
        .custom-check {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.25rem 0;
        }

        .custom-check input {
            width: 1.1rem;
            height: 1.1rem;
            flex-shrink: 0;
            accent-color: #f97316;
            cursor: pointer;
        }

        .custom-check span {
            white-space: nowrap; /* Force single line */
            font-size: 0.9rem;   /* Slightly smaller font to help fit */
            color: #374151;
        }

        /* Responsive: Drop columns on smaller screens */
        @media (max-width: 1280px) {
            .ingredients-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1024px) {
            .ingredients-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .ingredients-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">What's In Your <span>Fridge?</span></h1>
            <p class="hero-subtitle">Tick your ingredients and get instant recipe ideas!</p>

            <div class="ingredient-card">
                <form action="{{ route('ai.suggest') }}" method="POST" id="ai-form">
                    @csrf
                    
                    <input type="hidden" name="ingredients" id="ingredients-input">

                    <div class="ingredients-grid">
                        @php
                            $ingredients = [
                                'Onion' => 'Bawang Besar',
                                'Garlic' => 'Bawang Putih',
                                'Shallot' => 'Bawang Merah',
                                'Red Chili' => 'Cili Merah',
                                'Green Chili' => 'Cili Hijau',
                                'Ginger' => 'Halia',
                                'Fresh Turmeric' => 'Kunyit Hidup',
                                'Lemongrass' => 'Serai',
                                'Galangal' => 'Lengkuas',
                                'Lime' => 'Limau Nipis',
                                'Cabbage' => 'Kobis',
                                'Mustard Greens' => 'Sawi',
                                'Spinach' => 'Bayam',
                                'Water Spinach' => 'Kangkung',
                                'Carrot' => 'Lobak Merah',
                                'Tomato' => 'Tomato',
                                'Cucumber' => 'Timun',
                                'Eggplant' => 'Terung',
                                'Okra' => 'Bendi',
                                'Potato' => 'Kentang',
                                'Spring Onion' => 'Daun Bawang',
                                'Chinese Celery' => 'Daun Sup',
                                'Turmeric Leaf' => 'Daun Kunyit',
                                'Pandan Leaf' => 'Daun Pandan',
                                'Curry Leaf' => 'Daun Kari',
                                'Tamarind' => 'Asam Jawa',
                                'Garcinia Slice' => 'Asam Keping',
                                'Shrimp Paste' => 'Belacan',
                                'Vinegar' => 'Cuka',
                                'Cinnamon' => 'Kayu Manis',
                                'Cloves' => 'Cengkih',
                                'Cardamom' => 'Buah Pelaga',
                                'Star Anise' => 'Bunga Lawang',
                                'Coriander' => 'Ketumbar',
                                'Fennel Seeds' => 'Jintan Manis',
                                'Cumin Seeds' => 'Jintan Putih',
                                'Black Pepper' => 'Lada Hitam',
                                'Tofu' => 'Tauhu',
                                'Tempeh' => 'Tempe',
                                'Egg' => 'Telur',
                                'Chicken' => 'Ayam',
                                'Beef' => 'Daging Lembu',
                                'Goat Meat' => 'Daging Kambing',
                                'Fish' => 'Ikan',
                                'Shrimp' => 'Udang',
                                'Squid' => 'Sotong',
                                'Crab' => 'Ketam',
                                'Clams' => 'Kerang',
                            ];
                        @endphp

                        @foreach($ingredients as $en => $my)
                            <label class="custom-check">
                                <input type="checkbox" class="ingredient-checkbox" value="{{ $en }}">
                                <span>
                                    <strong>{{ $en }}</strong> / {{ $my }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <div class="form-group" style="border-top: 1px solid #eee; padding-top: 1.5rem;">
                        <label class="form-label">Anything else?</label>
                        <input type="text" id="extra-ingredients" class="form-control" placeholder="e.g. Mozzarella cheese, Leftover rice...">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full" style="width: 100%; font-size: 1.1rem; padding: 1rem;">
                        ✨ Generate Recipe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('ai-form');
            const checkboxes = document.querySelectorAll('.ingredient-checkbox');
            const hiddenInput = document.getElementById('ingredients-input');
            const extraInput = document.getElementById('extra-ingredients');

            function updateIngredients() {
                const selected = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
                
                const extra = extraInput.value.trim();
                if (extra) {
                    selected.push(extra);
                }

                hiddenInput.value = selected.join(', ');
            }

            checkboxes.forEach(cb => cb.addEventListener('change', updateIngredients));
            extraInput.addEventListener('input', updateIngredients);
        });
    </script>
</x-layout>