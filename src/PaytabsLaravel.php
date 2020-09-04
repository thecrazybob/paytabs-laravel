<?php

namespace Thecrazybob\PaytabsLaravel;

class PaytabsLaravel
{
    public function createPayment($order_details, $customer_details)
    {
        // Gateway Configuration Parameters
        $merchantId = config('paytabs-laravel.merchant_id');
        $secretKey = config('paytabs-laravel.merchant_secret_key');
        $callbackUrl = config('paytabs-laravel.callback_url');
        $cancelUrl = config('paytabs-laravel.cancel_url');
        $tokenization = config('paytabs-laravel.enable_tokenization');

        // Gateway Customization Parameters
        $showBilling = config('paytabs-laravel.show_billing');
        $showHeader = config('paytabs-laravel.show_header');
        $uiType = config('paytabs-laravel.ui_type');
        $color = config('paytabs-laravel.color');
        $imgHeight = config('paytabs-laravel.img_height');
        $imgWidth = config('paytabs-laravel.img_width');
        $imgUrl = config('paytabs-laravel.img_url');
        $customCss = config('paytabs-laravel.custom_css');

        // Order Parameters
        $orderId = $order_details['id'];
        $description = $order_details['description'];
        $amount = $order_details['amount'];
        $currencyCode = $order_details['currency_code'];

        // Client Parameters
        $clientId = $customer_details['id'];
        $firstname = $customer_details['first_name'];
        $lastname = $customer_details['last_name'];
        $email = $customer_details['email'];
        $address1 = $customer_details['address1'];
        $address2 = $customer_details['address2'];
        $city = $customer_details['city'];
        $state = $customer_details['state'];
        $postcode = $customer_details['postcode'];
        $country = $customer_details['country'];
        $phone = $customer_details['phonenumber'];
        $phone_country_code = $customer_details['phonecc'];

        // PayTabs Country Mapping
        $countries = '{"BD": "BGD", "BE": "BEL", "BF": "BFA", "BG": "BGR", "BA": "BIH", "BB": "BRB", "WF": "WLF", "BL": "BLM", "BM": "BMU", "BN": "BRN", "BO": "BOL", "BH": "BHR", "BI": "BDI", "BJ": "BEN", "BT": "BTN", "JM": "JAM", "BV": "BVT", "BW": "BWA", "WS": "WSM", "BQ": "BES", "BR": "BRA", "BS": "BHS", "JE": "JEY", "BY": "BLR", "BZ": "BLZ", "RU": "RUS", "RW": "RWA", "RS": "SRB", "TL": "TLS", "RE": "REU", "TM": "TKM", "TJ": "TJK", "RO": "ROU", "TK": "TKL", "GW": "GNB", "GU": "GUM", "GT": "GTM", "GS": "SGS", "GR": "GRC", "GQ": "GNQ", "GP": "GLP", "JP": "JPN", "GY": "GUY", "GG": "GGY", "GF": "GUF", "GE": "GEO", "GD": "GRD", "GB": "GBR", "GA": "GAB", "SV": "SLV", "GN": "GIN", "GM": "GMB", "GL": "GRL", "GI": "GIB", "GH": "GHA", "OM": "OMN", "TN": "TUN", "JO": "JOR", "HR": "HRV", "HT": "HTI", "HU": "HUN", "HK": "HKG", "HN": "HND", "HM": "HMD", "VE": "VEN", "PR": "PRI", "PS": "PSE", "PW": "PLW", "PT": "PRT", "SJ": "SJM", "PY": "PRY", "IQ": "IRQ", "PA": "PAN", "PF": "PYF", "PG": "PNG", "PE": "PER", "PK": "PAK", "PH": "PHL", "PN": "PCN", "PL": "POL", "PM": "SPM", "ZM": "ZMB", "EH": "ESH", "EE": "EST", "EG": "EGY", "ZA": "ZAF", "EC": "ECU", "IT": "ITA", "VN": "VNM", "SB": "SLB", "ET": "ETH", "SO": "SOM", "ZW": "ZWE", "SA": "SAU", "ES": "ESP", "ER": "ERI", "ME": "MNE", "MD": "MDA", "MG": "MDG", "MF": "MAF", "MA": "MAR", "MC": "MCO", "UZ": "UZB", "MM": "MMR", "ML": "MLI", "MO": "MAC", "MN": "MNG", "MH": "MHL", "MK": "MKD", "MU": "MUS", "MT": "MLT", "MW": "MWI", "MV": "MDV", "MQ": "MTQ", "MP": "MNP", "MS": "MSR", "MR": "MRT", "IM": "IMN", "UG": "UGA", "TZ": "TZA", "MY": "MYS", "MX": "MEX", "IL": "ISR", "FR": "FRA", "IO": "IOT", "SH": "SHN", "FI": "FIN", "FJ": "FJI", "FK": "FLK", "FM": "FSM", "FO": "FRO", "NI": "NIC", "NL": "NLD", "NO": "NOR", "NA": "NAM", "VU": "VUT", "NC": "NCL", "NE": "NER", "NF": "NFK", "NG": "NGA", "NZ": "NZL", "NP": "NPL", "NR": "NRU", "NU": "NIU", "CK": "COK", "XK": "XKX", "CI": "CIV", "CH": "CHE", "CO": "COL", "CN": "CHN", "CM": "CMR", "CL": "CHL", "CC": "CCK", "CA": "CAN", "CG": "COG", "CF": "CAF", "CD": "COD", "CZ": "CZE", "CY": "CYP", "CX": "CXR", "CR": "CRI", "CW": "CUW", "CV": "CPV", "CU": "CUB", "SZ": "SWZ", "SY": "SYR", "SX": "SXM", "KG": "KGZ", "KE": "KEN", "SS": "SSD", "SR": "SUR", "KI": "KIR", "KH": "KHM", "KN": "KNA", "KM": "COM", "ST": "STP", "SK": "SVK", "KR": "KOR", "SI": "SVN", "KP": "PRK", "KW": "KWT", "SN": "SEN", "SM": "SMR", "SL": "SLE", "SC": "SYC", "KZ": "KAZ", "KY": "CYM", "SG": "SGP", "SE": "SWE", "SD": "SDN", "DO": "DOM", "DM": "DMA", "DJ": "DJI", "DK": "DNK", "VG": "VGB", "DE": "DEU", "YE": "YEM", "DZ": "DZA", "US": "USA", "UY": "URY", "YT": "MYT", "UM": "UMI", "LB": "LBN", "LC": "LCA", "LA": "LAO", "TV": "TUV", "TW": "TWN", "TT": "TTO", "TR": "TUR", "LK": "LKA", "LI": "LIE", "LV": "LVA", "TO": "TON", "LT": "LTU", "LU": "LUX", "LR": "LBR", "LS": "LSO", "TH": "THA", "TF": "ATF", "TG": "TGO", "TD": "TCD", "TC": "TCA", "LY": "LBY", "VA": "VAT", "VC": "VCT", "AE": "ARE", "AD": "AND", "AG": "ATG", "AF": "AFG", "AI": "AIA", "VI": "VIR", "IS": "ISL", "IR": "IRN", "AM": "ARM", "AL": "ALB", "AO": "AGO", "AQ": "ATA", "AS": "ASM", "AR": "ARG", "AU": "AUS", "AT": "AUT", "AW": "ABW", "IN": "IND", "AX": "ALA", "AZ": "AZE", "IE": "IRL", "ID": "IDN", "UA": "UKR", "QA": "QAT", "MZ": "MOZ"}';

        $countries_array = json_decode($countries, true);

        $selected_country_iso3_code = $countries_array[$customer_details['country_code']];

        // Parameters to be sent to PayTabs
        $formFields = [
            'merchant-id' => $merchantId,
            'secret-key' => $secretKey,
            'url-redirect' => $callbackUrl,
            'url-cancel' => $cancelUrl,
            'amount' => $amount,
            'currency' => $currencyCode,
            'order-id' => $orderId,
            'customer-email-address' => $email,
            'billing-full-address' => $address1 . ' ' . $address2,
            'billing-city' => $city,
            'billing-country' => $selected_country_iso3_code,
            'billing-postal-code' => $postcode,
            'billing-state' => $state,
            'title' => 'Payment for Order #' . $orderId,
            'product-names' => $description,
            'customer-phone-number' => $phone,
            'customer-country-code' => $phone_country_code,
            'is-tokenization' => $tokenization,
            'ui-type' => $uiType,
            'color' => $color,
            'ui-element-id' => 'frmRemoteCardProcess',
            'ui-show-billing-address' => $showBilling,
            'ui-show-header' => $showHeader,
            'checkout-button-width' => $imgWidth,
            'checkout-button-height' => $imgHeight,
            'checkout-button-img-url' => $imgUrl,
            'custom-css' => preg_replace("/\r|\n/", "", $customCss),
        ];

        $formOutput = '';

        foreach ($formFields as $key => $value) {
            $formOutput .= 'data-' . $key . '=' . '"' . $value . '"' . PHP_EOL;
        }

        // Post params to PayTabs
        return '<script src="https://www.paytabs.com/express/v4/paytabs-express-checkout.js"
                   id="paytabs-express-checkout"
                   ' . $formOutput . '
                   >
                </script>';
    }

    public function callback()
    {
    }

    public function verifyTransaction()
    {
    }

    public function compareHashString()
    {
    }

    public function calculateFee()
    {
    }
}
