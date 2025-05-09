<div class="container-main print-container max-w-6xl overflow-auto">

    <img class="mx-auto hidden print-only w-64" src="/logo.webp" alt="">

    <!-- Property Details -->
        <button onclick="window.history.back()" class="my-auto flex space-x-2 cursor-pointer no-print">
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'arrow-left', 'class' => 'size-6']) ?>
            <p>Return</p>
        </button>
        <h2 class="hidden md:block main-title-page text-wrap">Property of <?= esc($property->client_name) ?></h2>

    <h2 class="md:hidden main-title-page">Property of <?= esc($property->client_name) ?></h2>

    <!-- Action buttons -->
    <div class="flex flex-row justify-around w-full items-center no-print py-3 my-5 bg-gray-50 rounded-lg shadow-sm">
        <a href="/listings/<?= esc($property->property_id) ?>/files" class="group flex space-x-2 cursor-pointer no-print hover:text-red-600 transition-colors p-2">
            <p>Images</p>
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'images', 'class' => 'group-hover:fill-red-400 size-6 ml-1']) ?>
        </a>

        <div class="h-8 w-px bg-gray-300 hidden md:block"></div>

        <button onclick="window.print()" class="group flex space-x-2 cursor-pointer no-print hover:text-red-600 transition-colors p-2">
            <p>Print</p>
            <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'printer', 'class' => 'group-hover:stroke-red-400 size-6 ml-1']) ?>
        </button>

        <?php if ($property->employee_id === $employee_id) : ?>
            <div class="h-8 w-px bg-gray-300 hidden md:block"></div>

            <a href="/listings/edit/<?= $property->property_id ?>" class="flex space-x-2 cursor-pointer no-print hover:text-red-600 transition-colors p-2">
                <p>Edit</p>
                <?= view_cell('App\Cells\Utils\Icons\IconsCell::render', ['icon' => 'edit', 'class' => 'size-6 ml-1']) ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="no-print">
        <?= view_cell('App\Cells\Utils\ErrorHandler\ErrorHandlerCell::render') ?>
    </div>

    <!-- Property state selection -->
    <div class="no-print flex flex-col md:flex-row justify-around space-y-4 md:space-y-0 md:space-x-4 w-full mb-6">
        <div class="w-full md:w-3/6 grid grid-cols-2 gap-2 place-items-center bg-white p-4 rounded-lg shadow-sm">
            <strong class="text-gray-700">Property State:</strong>
            <select id="property-state" <?= $property->employee_id !== $employee_id ? 'disabled' : '' ?>
                class="secondary-input min-w-40 max-w-60">
                <?php foreach ($propertyStatuses as $propertyState): ?>
                    <option value="<?= $propertyState['id'] ?>"
                        <?= strtolower($propertyState['id']) === strtolower($property->property_status_id) ? 'selected' : '' ?>><?= ucfirst($propertyState['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="my-8 bg-white p-2 md:p-10 shadow-md rounded-md overflow-auto w-full max-w-6xl mx-auto print-container">

        <!-- Tabs Navigation -->
        <div class="no-print mb-6 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="tab-button active inline-block p-4 border-b-2 rounded-t-lg"
                        id="vendor-tab"
                        data-target="vendor-content"
                        type="button"
                        role="tab">
                        Vendor Information
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg"
                        id="property-tab"
                        data-target="property-content"
                        type="button"
                        role="tab">
                        Property Details
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg"
                        id="pricing-tab"
                        data-target="pricing-content"
                        type="button"
                        role="tab">
                        Pricing
                    </button>
                </li>
                <?php if ($landDetails): ?>
                    <li class="mr-2" role="presentation">
                        <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg"
                            id="land-tab"
                            data-target="land-content"
                            type="button"
                            role="tab">
                            Land Details
                        </button>
                    </li>
                <?php endif; ?>
                <?php if ($apartmentDetails): ?>
                    <li class="mr-2" role="presentation">
                        <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg"
                            id="apartment-tab"
                            data-target="apartment-content"
                            type="button"
                            role="tab">
                            Apartment Details
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg"
                            id="partition-tab"
                            data-target="partition-content"
                            type="button"
                            role="tab">
                            Apartment Partitions
                        </button>
                    </li>
                    <li role="presentation">
                        <button class="tab-button inline-block p-4 border-b-2 border-transparent rounded-t-lg"
                            id="specifications-tab"
                            data-target="specifications-content"
                            type="button"
                            role="tab">
                            Apartment Specifications
                        </button>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Tab Content -->

        <!-- Vendor Information Tab -->
        <div id="vendor-content" class="tab-content active">
            <h2 class="secondary-title flex items-center">
                <i class="fas fa-user mr-2 text-blue-600"></i> Vendor Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <!-- Client Information -->
                <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                        <i class="fas fa-id-card mr-2 text-indigo-500"></i> Client Details
                    </h4>
                    <table class="w-full">
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                <i class="fas fa-user-tie mr-2 "></i> Name
                            </th>
                            <td class="py-2 px-3">
                                <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    <?= esc($property->client_name) ?>
                                </span>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                <i class="fas fa-envelope mr-2 "></i> Email
                            </th>
                            <td class="py-2 px-3">
                                <a href="mailto:<?= esc($property->client_email) ?>" class="flex items-center hover:text-blue-600">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($property->client_email) ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <!-- Phone Number Section (Enhanced for Multiple Numbers) -->
                        <tr>
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                <i class="fas fa-phone mr-2 "></i> Phone
                            </th>
                            <td class="py-2 px-3">
                                <?php
                                // Handle multiple phone numbers (comma or semicolon separated)
                                $phoneNumbers = preg_split('/[,;]+/', $property->client_phone);

                                if (count($phoneNumbers) > 1): // Multiple phone numbers
                                ?>
                                    <div class="flex flex-col space-y-2">
                                        <?php foreach ($phoneNumbers as $index => $phone):
                                            $phone = trim($phone);
                                            if (empty($phone)) continue;
                                        ?>
                                            <a href="tel:<?= esc($phone) ?>" class="flex items-center hover:text-blue-600">
                                                <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                                    <?= esc($phone) ?>
                                                    <?php if ($index === 0): ?>
                                                        <span class="ml-1 text-xs bg-green-100 text-green-800 px-1 rounded">Primary</span>
                                                    <?php endif; ?>
                                                </span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php elseif (count($phoneNumbers) === 1) : // Single phone number 
                                ?>
                                    <a href="tel:<?= esc($property->client_phone) ?>" class="flex items-center hover:text-blue-600">
                                        <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <?= esc($property->client_phone) ?>
                                        </span>
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-500 italic">No phone number provided</span>
                                <?php endif; ?>
                            </td>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Referral Information -->
                <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                        <i class="fas fa-handshake mr-2 text-purple-500"></i> Referral Information
                    </h4>
                    <table class="w-full">
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                <i class="fas fa-user-friends mr-2"></i> Name
                            </th>
                            <td class="py-2 px-3">
                                <?php if (!empty($property->property_referral_name)): ?>
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($property->property_referral_name) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-500 italic">No referral provided</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                <i class="fas fa-phone mr-2 "></i> Phone
                            </th>
                            <td class="py-2 px-3">
                                <?php if (!empty($property->property_referral_phone)): ?>
                                    <a href="tel:<?= esc($property->property_referral_phone) ?>" class="flex items-center hover:text-blue-600">
                                        <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <?= esc($property->property_referral_phone) ?>
                                        </span>
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-500 italic">No phone number provided</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Contact Actions -->
            <div class="no-print mt-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">
                    <i class="fas fa-address-book mr-2 text-blue-500"></i> Quick Contact Actions
                </h4>
                <div class="flex flex-wrap gap-3">
                    <?php
                    $clientPhones = preg_split('/[,;]+/', $property->client_phone);
                    $primaryClientPhone = trim($clientPhones[0]);
                    ?>
                    <a href="tel:<?= esc($primaryClientPhone) ?>" class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-md hover:bg-green-200 transition-colors no-print">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Call Client
                    </a>

                    <a href="mailto:<?= esc($property->client_email) ?>" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800  rounded-md hover:bg-blue-200 transition-colors no-print">
                        <i class="fas fa-envelope mr-2"></i>
                        Email Client
                    </a>

                    <?php if (!empty($property->property_referral_phone)):
                        $refPhones = preg_split('/[,;]+/', $property->property_referral_phone);
                        $primaryRefPhone = trim($refPhones[0]);
                    ?>
                        <a href="tel:<?= esc($primaryRefPhone) ?>" class="inline-flex items-center px-4 py-2 bg-amber-100 text-amber-800 rounded-md hover:bg-amber-200 transition-colors no-print">
                            <i class="fas fa-phone-alt mr-2"></i>
                            Call Referral
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Property Details Tab -->
        <div id="property-content" class="tab-content hidden">
            <h2 class="secondary-title flex items-center">
                <i class="fas fa-home mr-2 text-indigo-600"></i> Property Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <!-- Basic Information -->
                <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i> Basic Information
                    </h4>
                    <table class=" w-full">
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                Agent
                            </th>
                            <td class="py-2 px-3">
                                <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    <?= esc($property->employee_name) ?>
                                </span>
                            </td>
                        </tr>

                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                 Size
                            </th>
                            <td class="py-2 px-3">
                                <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    <?= esc($property->property_size) ?> m²
                                </span>
                            </td>
                        </tr>
                        <tr class="">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                 Status
                            </th>
                            <td class="py-2 px-3">
                              
                                <span class="bade badge-warning px-3 py-1 rounded-full text-sm font-medium">
                                    <?= esc($property->property_status_name) ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>



                <!-- Status Information -->
                <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                    <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                        <i class="far fa-clock mx-1 text-green-500"></i> Time
                    </h4>
                    <table class="w-full">

                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                 Created
                            </th>
                            <td class="py-2 px-3">
                                <div class="flex items-center">
                                    <i class="far fa-calendar-alt mr-1 text-gray-500"></i>
                                    <span class="text-sm">
                                        <?= esc((new DateTime($property->property_created_at))->format('d-M-Y')) ?>
                                    </span>
                                    <i class="far fa-clock mx-1 text-gray-500"></i>
                                    <span class="text-sm">
                                        <?= esc((new DateTime($property->property_created_at))->format('H:i T')) ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                Updated
                            </th>
                            <td class="py-2 px-3">
                                <div class="flex items-center">
                                    <i class="far fa-calendar-alt mr-1 text-gray-500"></i>
                                    <span class="text-sm">
                                        <?= esc((new DateTime($property->property_updated_at))->format('d-M-Y')) ?>
                                    </span>
                                    <i class="far fa-clock mx-1 text-gray-500"></i>
                                    <span class="text-sm">
                                        <?= esc((new DateTime($property->property_updated_at))->format('H:i T')) ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 text-left text-gray-600 flex items-center">
                                Age
                            </th>
                            <td class="">
                                <?php
                                $createdDate = new DateTime($property->property_created_at);
                                $updatedDate = new DateTime($property->property_updated_at);
                                $interval = $createdDate->diff($updatedDate);
                                $daysAge = $interval->days;
                                ?>
                                <span class="ml-2"><?= $daysAge ?> days</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Location -->
            <div class="no-break-page bg-gray-50 p-4 mt-4 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                    <i class="fas fa-map
                        mr-2 text-green-500"></i> Location
                </h4>
                <!-- Description -->
                <div class="prose prose-sm max-w-none text-gray-700">
                    <p class="">
                        <?= esc($property->property_detailed_location) ?>
                    </p>
                </div>
            </div>

            <!-- Catchphrase/Description -->
            <div class="no-break-page mt-6 bg-gray-50 p-4 rounded-lg shadow-sm">
                <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                    <i class="fas fa-bullhorn mt-1 mr-2 text-red-400"></i> Catch Phrase
                </h4>
                <div class="prose prose-sm max-w-none text-gray-700">
                    <p class="">
                        <?= esc($property->property_catch_phrase) ?>
                    </p>
                </div>
            </div>


        </div>


        <!-- Pricing Tab -->
        <div id="pricing-content" class="tab-content hidden">
            <h2 class="secondary-title flex items-center">
                <i class="fas fa-tags mr-2 text-green-600"></i> Property Pricing
            </h2>

            <!-- Payment Plan Section -->
            <?php if ($property->property_payment_plan): ?>
                <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3 flex items-center">
                        <i class="fas fa-file-invoice-dollar mr-2 "></i> Payment Plan
                    </h3>
                    <div class="prose prose-sm max-w-none text-gray-700">
                        <p class="">
                            <?= esc($property->property_payment_plan) ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Property Prices Section -->
            <?php if (isset($propertyPrices) && !empty($propertyPrices)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($propertyPrices as $index => $price): ?>
                        <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm <?= $price->property_price_is_primary ? 'order-first border-l-4 border-red-500' : '' ?>">
                            <div class="flex justify-between items-center border-b border-gray-300 pb-2 mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <?php if ($price->property_price_type === 'rent'): ?>
                                        <i class="fas fa-key mr-2 "></i>
                                    <?php else: ?>
                                        <i class="fas fa-home mr-2 "></i>
                                    <?php endif; ?>
                                    <?= ucfirst($price->property_price_type) ?> Price
                                </h3>
                                <?php if ($price->property_price_is_primary): ?>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                                        <i class="fas fa-star mr-1"></i> Primary
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Price Card Content -->
                            <div class="mb-4">
                                <!-- Price Amount Highlight -->
                                <div class="bg-white rounded-lg p-3 mb-4 border border-gray-200 shadow-sm flex justify-between items-center">
                                    <span class="text-gray-600 font-medium flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2 "></i>
                                        <?php if ($price->property_price_type === 'rent'): ?>
                                            <?= ucfirst($price->property_price_rent_period) ?> Rate:
                                        <?php else: ?>
                                            Selling Price:
                                        <?php endif; ?>
                                    </span>
                                    <span class="text-xl font-bold ">
                                        <?= number_format($price->property_price_amount) ?> <span class=""><?= $currencySymbols[$price->property_price_currency_id] ?? '' ?></span>
                                    </span>
                                </div>

                                <!-- Price Details Table -->
                                <table class="w-full">
                                    <?php if ($price->property_price_type === 'rent'): ?>
                                        <tr class="border-b border-gray-200">
                                            <th class="py-2 text-left text-gray-600 flex items-center">
                                                 Rent Period
                                            </th>
                                            <td class="py-2 px-3">
                                                <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                                    <?= ucfirst($price->property_price_rent_period) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>



                                    <?php if ($price->property_price_type === 'sale'): ?>
                                        <tr>
                                            <th class="py-2 text-left text-gray-600 flex items-center">
                                                 Payment Terms
                                            </th>
                                            <td class="py-2 px-3">
                                                <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                                    <?= ucfirst($price->property_price_payment_terms) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600 flex items-center">
                                             Negotiable
                                        </th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $price->property_price_is_negotiable ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> px-3 py-1 rounded-full text-sm font-medium">
                                                <?= $price->property_price_is_negotiable ? "Yes" : "No" ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
               
            <?php else: ?>
                <div class="no-break-page bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i>
                        <p class="text-yellow-700">No pricing information available for this property.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Land Details Tab -->
        <?php if ($landDetails): ?>
            <div id="land-content" class="tab-content hidden ">
                <h2 class="secondary-title flex items-center">
                    <i class="fas fa-mountain mr-2 text-green-600"></i> Land Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Land Information -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i> Basic Information
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-map mr-2 "></i> Land Type
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($landDetails->land_type) ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Zoning Information -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-layer-group mr-2 text-purple-500"></i> Zoning Information
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-chart-pie mr-2"></i> Zone 1
                                </th>
                                <td class="py-2 px-3">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-red-600 h-2.5 rounded-full" style="width: <?= esc($landDetails->land_zone_first) ?>%"></div>
                                        </div>
                                        <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <?= esc($landDetails->land_zone_first) ?>%
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-chart-pie mr-2 "></i> Zone 2
                                </th>
                                <td class="py-2 px-3">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= esc($landDetails->land_zone_second) ?>%"></div>
                                        </div>
                                        <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <?= esc($landDetails->land_zone_second) ?>%
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        <?php endif; ?>

        <!-- Apartment Details Tab -->
        <?php if ($apartmentDetails): ?>
            <div id="apartment-content" class="tab-content hidden">
                <h2 class="secondary-title flex items-center">
                    <i class="fas fa-building mr-2 text-red-500"></i> Apartment Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Basic Information -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i> Basic Information
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                     Gender
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($apartmentDetails->apartment_gender_name) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                     Type
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($apartmentDetails->apartment_type_name) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                     Status Age
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($apartmentDetails->ad_status_age) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    View
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($apartmentDetails->ad_view) ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Building Information -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-city mr-2 text-indigo-500"></i> Building Information
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    Floor Level
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($apartmentDetails->ad_floor_level) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                     Apartments Per Floor
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= esc($apartmentDetails->ad_apartments_per_floor) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    Elevator
                                </th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->ad_elevator ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> px-3 py-1 rounded-full text-sm font-medium">
                                        <?= $apartmentDetails->ad_elevator ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    Furnished
                                </th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->ad_furnished ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> px-3 py-1 rounded-full text-sm font-medium">
                                        <?= $apartmentDetails->ad_furnished ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Outdoor Spaces -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm md:col-span-2">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-umbrella-beach mr-2 text-teal-500"></i> Outdoor Spaces
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <table class="w-full">
                                <tr class="border-b border-gray-200">
                                    <th class="py-2 text-left text-gray-600 flex items-center">
                                         Terrace
                                    </th>
                                    <td class="py-2">
                                        <span class="<?= $apartmentDetails->ad_terrace ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> px-3 py-1 rounded-full text-sm font-medium">
                                            <?= $apartmentDetails->ad_terrace ? 'Yes' : 'No' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php if ($apartmentDetails->ad_terrace): ?>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600 flex items-center">
                                            Terrace Area
                                        </th>
                                        <td class="py-2">
                                            <span class=" text-gray-700 py-1 rounded-full text-sm font-medium">
                                                <?= esc($apartmentDetails->ad_terrace_area) ?> m²
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>

                            <table class="w-full h-fit">
                                <tr class="border-b border-gray-200">
                                    <th class="py-2 text-left text-gray-600 flex items-center">
                                        Roof
                                    </th>
                                    <td class="py-2">
                                        <span class="<?= $apartmentDetails->ad_roof ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> px-3 py-1 rounded-full text-sm font-medium">
                                            <?= $apartmentDetails->ad_roof ? 'Yes' : 'No' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php if ($apartmentDetails->ad_roof): ?>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600 flex items-center">
                                            Roof Area
                                        </th>
                                        <td class="py-2">
                                            <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                                <?= esc($apartmentDetails->ad_roof_area) ?> m²
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Apartment Partitions Tab -->
            <div id="partition-content" class="tab-content hidden">
                <h3 class="secondary-title mt-6 flex items-center">
                    <i class="fas fa-puzzle-piece mr-2 text-red-500"></i> Apartment Partition
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Living Spaces -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-couch mr-2 text-blue-500"></i> Living Spaces
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-tv mr-2"></i> Salon
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_salon) ? $apartmentDetails->partition_salon : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-utensils mr-2"></i> Dining
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_dining) ? $apartmentDetails->partition_dining : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-chair mr-2"></i> Sitting Corner
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_sitting_corner) ? $apartmentDetails->partition_sitting_corner : '0' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Bedrooms -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-bed mr-2 text-indigo-500"></i> Bedrooms
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-star mr-2"></i> Master Bedroom
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_master_bedroom) ? $apartmentDetails->partition_master_bedroom : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-bed mr-2"></i> Bedroom
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_bedroom) ? $apartmentDetails->partition_bedroom : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-user-tie mr-2"></i> Maid Room
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_maid_room) ? $apartmentDetails->partition_maid_room : '0' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Utility Spaces -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-university mr-2 text-green-500"></i> Utility Spaces
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-sink mr-2"></i> Kitchen
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_kitchen) ? $apartmentDetails->partition_kitchen : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-shower mr-2 "></i> Bathroom
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_bathroom) ? $apartmentDetails->partition_bathroom : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-box mr-2"></i> Storage Room
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_storage_room) ? $apartmentDetails->partition_storage_room : '0' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Outdoor Spaces -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-umbrella-beach mr-2 text-orange-500"></i> Outdoor Spaces
                        </h4>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-door-open mr-2"></i> Reception Balcony
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_reception_balcony) ? $apartmentDetails->partition_reception_balcony : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-wind mr-2"></i> Balconies
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_balconies) ? $apartmentDetails->partition_balconies : '0' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600 flex items-center">
                                    <i class="fas fa-car mr-2"></i> Parking
                                </th>
                                <td class="py-2 px-3">
                                    <span class=" text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        <?= !empty($apartmentDetails->partition_parking) ? $apartmentDetails->partition_parking : '0' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Summary -->
                <div class="no-break-page mt-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i> Room Count Summary
                    </h4>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $partitionFields = [
                            'partition_salon' => ['icon' => 'tv', 'label' => 'Salon'],
                            'partition_dining' => ['icon' => 'utensils', 'label' => 'Dining'],
                            'partition_kitchen' => ['icon' => 'sink', 'label' => 'Kitchen'],
                            'partition_master_bedroom' => ['icon' => 'star', 'label' => 'Master Bedroom'],
                            'partition_bedroom' => ['icon' => 'bed', 'label' => 'Bedroom'],
                            'partition_bathroom' => ['icon' => 'shower', 'label' => 'Bathroom'],
                            'partition_balconies' => ['icon' => 'wind', 'label' => 'Balconies']
                        ];

                        foreach ($partitionFields as $field => $info):
                            if (!empty($apartmentDetails->$field) && $apartmentDetails->$field > 0):
                        ?>
                                <span class="badge badge-info flex items-center">
                                    <i class="fas fa-<?= $info['icon'] ?> mr-1"></i>
                                    <?= $info['label'] ?>: <?= $apartmentDetails->$field ?>
                                </span>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <!-- Specifications Tab -->
            <div id="specifications-content" class="tab-content hidden">
                <h2 class="secondary-title">Apartment Specifications</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Climate Control -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-temperature-low mr-2 text-red-500"></i> Climate Control
                        </h3>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Heating System</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_heating_system ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_heating_system ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Heating Provision</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_heating_system_provision ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_heating_system_provision ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">AC System</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_ac_system ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_ac_system ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-gray-600">AC Provision</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_ac_system_provision ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_ac_system_provision ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Insulation & Windows -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-window-maximize mr-2 text-blue-500"></i> Insulation & Windows
                        </h3>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Double Wall</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_double_wall ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_double_wall ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Double Glazing</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_double_glazing ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_double_glazing ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-gray-600">Electrical Shutters</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_shutters_electrical ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_shutters_electrical ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Interior Features -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-home mr-2 text-amber-500"></i> Interior Features
                        </h3>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Oak Doors</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_oak_doors ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_oak_doors ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Chimney</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_chimney ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_chimney ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Indirect Light</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_indirect_light ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_indirect_light ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Wood Panel Decoration</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_wood_panel_decoration ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_wood_panel_decoration ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-gray-600">Stone Panel Decoration</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_stone_panel_decoration ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_stone_panel_decoration ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Security & Utilities -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-shield-alt mr-2 text-indigo-500"></i> Security & Utilities
                        </h3>
                        <table class="w-full">
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Security Door</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_security_door ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_security_door ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Alarm System</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_alarm_system ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_alarm_system ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th class="py-2 text-left text-gray-600">Solar Heater</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_solar_heater ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_solar_heater ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left text-gray-600">Intercom</th>
                                <td class="py-2 px-3">
                                    <span class="<?= $apartmentDetails->spec_intercom ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                        <?= $apartmentDetails->spec_intercom ? 'Yes' : 'No' ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Amenities -->
                    <div class="no-break-page bg-gray-50 p-4 rounded-lg shadow-sm md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-3">
                            <i class="fas fa-concierge-bell mr-2 text-purple-500"></i> Amenities & Additional Features
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <table class="w-full">
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600">Garage</th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $apartmentDetails->spec_garage ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                                <?= $apartmentDetails->spec_garage ? 'Yes' : 'No' ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600">Driver Room</th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $apartmentDetails->spec_driver_room ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                                <?= $apartmentDetails->spec_driver_room ? 'Yes' : 'No' ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div>
                                <table class="w-full">
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600">Jacuzzi</th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $apartmentDetails->specs_jacuzzi ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                                <?= $apartmentDetails->specs_jacuzzi ? 'Yes' : 'No' ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600">Swimming Pool</th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $apartmentDetails->spec_swimming_pool ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                                <?= $apartmentDetails->spec_swimming_pool ? 'Yes' : 'No' ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div>
                                <table class="w-full">
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600">Gym</th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $apartmentDetails->spec_gym ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                                <?= $apartmentDetails->spec_gym ? 'Yes' : 'No' ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-2 text-left text-gray-600">Kitchenette</th>
                                        <td class="py-2 px-3">
                                            <span class="<?= $apartmentDetails->spec_kitchenette ? 'badge-success' : 'badge' ?> badge px-2 py-1 rounded-md text-sm">
                                                <?= $apartmentDetails->spec_kitchenette ? 'Yes' : 'No' ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4">
                            <table class="w-fit">
                                <tr>
                                    <th class="py-2 text-left text-gray-600">Tiles</th>
                                    <td class="py-2 px-3">
                                        <span class=" text-gray-700 px-2 py-1 rounded-md text-base">
                                            <?= esc(ucfirst($apartmentDetails->spec_tiles)) ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Specifications Summary -->
                <div class="no-break-page mt-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Features Summary</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $features = [
                            'spec_heating_system' => 'Heating',
                            'spec_ac_system' => 'AC System',
                            'spec_double_wall' => 'Double Wall',
                            'spec_double_glazing' => 'Double Glazing',
                            'spec_oak_doors' => 'Oak Doors',
                            'spec_security_door' => 'Security Door',
                            'spec_alarm_system' => 'Alarm System',
                            'spec_solar_heater' => 'Solar Heater',
                            'spec_swimming_pool' => 'Swimming Pool',
                            'spec_gym' => 'Gym'
                        ];

                        foreach ($features as $key => $label):
                            if ($apartmentDetails->$key):
                        ?>
                                <span class="badge badge-info">
                                    <?= $label ?>
                                </span>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const propertyState = document.getElementById('property-state');
        const errorDiv = document.getElementById('error-div');
        const successDiv = document.getElementById('success-div');

        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active state from all buttons and content
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('border-red-600');
                    btn.classList.remove('text-red-600');
                    btn.classList.add('border-transparent');
                });

                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Add active state to clicked button
                button.classList.add('active');
                button.classList.add('border-red-600');
                button.classList.add('text-red-600');

                // Show corresponding content
                const targetId = button.getAttribute('data-target');
                document.getElementById(targetId).classList.remove('hidden');

                // Save active tab to localStorage for persistence
                localStorage.setItem('activePropertyTab', targetId);
            });
        });

        // Restore active tab from localStorage if available
        const savedTab = localStorage.getItem('activePropertyTab');
        if (savedTab) {
            const savedButton = document.querySelector(`[data-target="${savedTab}"]`);
            if (savedButton) {
                savedButton.click();
            }
        }

        // Property state change functionality
        propertyState.addEventListener('change', async function() {
            const state = propertyState.value;
            const property_id = <?= $property->property_id ?>;

            try {
                await fetch(`/api/listings/update-status/${property_id}/${state}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successDiv.classList.remove('hidden');
                            successDiv.innerHTML = data.message;
                        } else {
                            //Prevent changing the value of the select element
                            propertyState.value = '<?= $property->property_status_id ?>';
                            errorDiv.classList.remove('hidden');
                            errorDiv.innerHTML = data.message;
                        }
                    });

            } catch (e) {
                errorDiv.classList.remove('hidden');
                errorDiv.innerHTML = data.message;
            }
            setTimeout(() => {
                successDiv.classList.add('hidden');
                errorDiv.classList.add('hidden');
            }, 5000);
        });
    });
</script>

<style>
    @media print {

        table th {
            width: 50%;
        }

    }
</style>