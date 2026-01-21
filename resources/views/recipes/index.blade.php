<x-layout>
    <div style="display: flex; gap: 40px; padding: 40px 0;">
        
        <aside style="width: 250px; flex-shrink: 0;">
            <h3 style="font-size: 1.2rem; font-weight: 700; color: #431407; margin-bottom: 20px;">Filters</h3>
            
            <div style="margin-bottom: 25px;">
                <h4 style="font-size: 0.9rem; font-weight: 600; color: #F97316; margin-bottom: 10px;">Cuisine</h4>
                <label style="display: block; margin-bottom: 8px; color: #57534e;">
                    <input type="checkbox" style="accent-color: #F97316;"> Malaysian
                </label>
                <label style="display: block; margin-bottom: 8px; color: #57534e;">
                    <input type="checkbox" style="accent-color: #F97316;"> Indonesian
                </label>
                <label style="display: block; margin-bottom: 8px; color: #57534e;">
                    <input type="checkbox" style="accent-color: #F97316;"> Western
                </label>
            </div>

            <div style="margin-bottom: 25px;">
                <h4 style="font-size: 0.9rem; font-weight: 600; color: #F97316; margin-bottom: 10px;">Meal Type</h4>
                <label style="display: block; margin-bottom: 8px; color: #57534e;">
                    <input type="checkbox"> Breakfast
                </label>
                <label style="display: block; margin-bottom: 8px; color: #57534e;">
                    <input type="checkbox"> Lunch / Dinner
                </label>
            </div>
        </aside>

        <div style="flex: 1;">
            <div style="margin-bottom: 30px; display: flex;">
                <input type="text" placeholder="Search for recipes (e.g. Nasi Goreng)..." 
                       style="width: 100%; padding: 15px 20px; border: 2px solid #fed7aa; border-radius: 50px; outline: none; font-size: 1rem;">
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
                <div class="recipe-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: .3s;">
                    <div style="height: 180px; background: #ddd; position: relative;">
                        <img src="{{ asset('images/sample-food.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <span style="position: absolute; top: 10px; right: 10px; background: white; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; color: #C2410C;">
                            20 min
                        </span>
                    </div>
                    <div style="padding: 20px;">
                        <span style="color: #F97316; font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">Malaysian</span>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #431407; margin: 5px 0 10px;">Kampung Fried Rice</h3>
                        <p style="color: #78716c; font-size: 0.9rem; margin-bottom: 15px;">Authentic spicy fried rice with anchovies and water spinach.</p>
                        <a href="#" style="color: #C2410C; font-weight: 600; text-decoration: none;">View Recipe →</a>
                    </div>
                </div>
                </div>
        </div>
    </div>
</x-layout>