<div class="container-main">

    <h1 class="main-title-page">Settings</h1>

    <?= view_cell('\App\Cells\Settings\SettingsCell::render') ?>

    <br />

    <h2 class="main-title-page">Add Location</h2>

    <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>

    <div class="my-8 bg-white p-10 shadow-md rounded-md w-full overflow-auto px-auto">

        <div class="accordion-section">
            <button class="accordion-toggle">Edit Countries</button>
            <div class="accordion-content">
                <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\CountryCell::render') ?>
            </div>
        </div>

        <hr class="my-8">



        <div class="accordion-section">
            <button class="accordion-toggle">Edit Regions</button>
            <div class="accordion-content">
                <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\RegionCell::render') ?>
            </div>
        </div>

        <hr class="my-8">



        <div class="accordion-section">
            <button class="accordion-toggle">Edit Subregions</button>
            <div class="accordion-content">
                <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\SubregionCell::render') ?>
            </div>
        </div>
        <hr class="my-8">

        <div class="accordion-section">
            <button class="accordion-toggle">Edit Cities</button>
            <div class="accordion-content">
                <?= view_cell('App\Cells\Settings\Location\FormsLocationCells\CityCell::render') ?>
            </div>
        </div>

    </div>


    <style>
        .accordion-toggle {
            background-color: #F8F8F8;
            text-align: left;
            cursor: pointer;
            padding: 1rem;
            width: 100%;
            font-size: 1.25rem;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            padding: 0 1rem;
            background-color: white;
            border: 1px solid #F8F8F8;
        }


    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.accordion-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const content = this.nextElementSibling;

                    // Close all other accordion contents
                    document.querySelectorAll('.accordion-content').forEach(otherContent => {
                        if (otherContent !== content) {
                            otherContent.style.maxHeight = null;
                        }
                    });

                    // Toggle the clicked accordion content
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        });
    </script>

</div>