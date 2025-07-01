<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Visualization</title>
    <!-- Tailwind CSS for basic styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 24px;
            max-width: 1200px;
            width: 100%;
        }
        #tableauViz {
            width: 100%;
            height: 800px; /* Adjust height as needed */
            overflow: hidden; /* Prevent scrollbars if Tableau content is smaller */
            border-radius: 8px; /* Rounded corners for the viz container */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Tableau Dashboard</h1>
        <div id="tableauViz">
            <!-- Tableau visualization will be embedded here -->
        </div>
    </div>

    <!-- Tableau JavaScript API -->
    <script type="text/javascript" src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
    <script type="text/javascript">
        // Ensure the DOM is fully loaded before trying to embed Tableau
        window.onload = function initViz() {
            var containerDiv = document.getElementById("tableauViz");
            var url = "https://public.tableau.com/views/NewWorkbook_17466425656430/Sheet2?:language=en-US&:sid=&:redirect=auth&:display_count=n&:origin=viz_share_link";
            var options = {
                hideTabs: true, // You can set this to false if you want to show tabs
                hideToolbar: true, // You can set this to false if you want to show the toolbar
                onFirstInteractive: function () {
                    console.log("Tableau viz is interactive.");
                }
            };
            // Create a new Tableau Viz object and embed it in the containerDiv
            var viz = new tableau.Viz(containerDiv, url, options);

            // Optional: Add a resize observer for better responsiveness if the viz itself doesn't adapt well
            const resizeObserver = new ResizeObserver(entries => {
                for (let entry of entries) {
                    if (entry.target.id === 'tableauViz') {
                        console.log('TableauViz container resized:', entry.contentRect.width, entry.contentRect.height);
                        // No need to explicitly re-draw if Tableau API handles it, but good for debugging
                    }
                }
            });
            resizeObserver.observe(containerDiv);
        };
    </script>
</body>
</html>
