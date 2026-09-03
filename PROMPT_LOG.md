# AI Prompt Log - Developer Portfolio Project

## Session 1: Layout & Blade Setup
* **Prompt:** "Generate a single-page Laravel Blade view using Tailwind CSS for a developer portfolio. Include sections for Profile Picture, Contact Details, School/Education, Skills, and Certifications with a dark modern theme."
* **AI Output:** Provided a full Blade view using standard Tailwind classes containing modern dynamic layout components.
* **Action Taken:** Accepted as-is for `resources/views/portfolio.blade.php`.

## Session 2: Controller & Data Structure
* **Prompt:** "Write a PortfolioController in Laravel that passes static arrays for profile details, education, skills, and certifications into a portfolio view."
* **AI Output:** Outputted `PortfolioController.php` returning data array to the view.
* **Action Taken:** Edited—updated education details to "Data Center College of the Philippines - Bangued" and filled in real skills and contact details.

## Session 3: Route & Navigation Fix
* **Prompt:** "How do I route the root URL '/' to use PortfolioController in web.php?"
* **AI Output:** Provided `Route::get('/', [PortfolioController::class, 'index']);`.
* **Action Taken:** Accepted as-is and added class import at top of file.

## Session 4: Deployment Configuration
* **Prompt:** "How do I configure `.htaccess` in Laravel for shared hosting on InfinityFree?"
* **AI Output:** Provided root `.htaccess` rules redirecting requests to the public directory.
* **Action Taken:** Accepted as-is and tested deployment structure.

## Session 5: UI/UX & Responsive Redesign
* **Prompt:** "Improvise the design of portfolio.blade.php with a sticky navigation bar, FontAwesome icons, glassmorphism cards, and modern dark-mode Tailwind CSS styling."
* **AI Output:** Provided updated single-page template with hero gradients, sticky navbar, dynamic skill badges, and responsive timeline layout.
* **Action Taken:** Accepted as-is for resources/views/portfolio.blade.php.