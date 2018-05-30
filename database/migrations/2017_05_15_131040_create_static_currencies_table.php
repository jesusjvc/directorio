<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_currencies', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('code', 50)->unique()->index();
            $table->string('name', 100);
            $table->string('symbol', 10);
            $table->integer('decimal_digits')->unsigned();
        });

        DB::table('static_currencies')->insert(
            [
                [
                    'symbol' => '$',
                    'name' => 'US Dollar',
                    'decimal_digits' => '2',
                    'code' => 'USD'
                ],
                [
                    'symbol' => 'CA$',
                    'name' => 'Canadian Dollar',
                    'decimal_digits' => '2',
                    'code' => 'CAD'
                ],
                [
                    'symbol' => '€',
                    'name' => 'Euro',
                    'decimal_digits' => '2',
                    'code' => 'EUR'
                ],
                [
                    'symbol' => 'AED',
                    'name' => 'United Arab Emirates Dirham',
                    'decimal_digits' => '2',
                    'code' => 'AED'
                ],
                [
                    'symbol' => 'Af',
                    'name' => 'Afghan Afghani',
                    'decimal_digits' => '0',
                    'code' => 'AFN'
                ],
                [
                    'symbol' => 'ALL',
                    'name' => 'Albanian Lek',
                    'decimal_digits' => '0',
                    'code' => 'ALL'
                ],
                [
                    'symbol' => 'AMD',
                    'name' => 'Armenian Dram',
                    'decimal_digits' => '0',
                    'code' => 'AMD'
                ],
                [
                    'symbol' => 'AR$',
                    'name' => 'Argentine Peso',
                    'decimal_digits' => '2',
                    'code' => 'ARS'
                ],
                [
                    'symbol' => 'AU$',
                    'name' => 'Australian Dollar',
                    'decimal_digits' => '2',
                    'code' => 'AUD'
                ],
                [
                    'symbol' => 'man.',
                    'name' => 'Azerbaijani Manat',
                    'decimal_digits' => '2',
                    'code' => 'AZN'
                ],
                [
                    'symbol' => 'KM',
                    'name' => 'Bosnia-Herzegovina Convertible Mark',
                    'decimal_digits' => '2',
                    'code' => 'BAM'
                ],
                [
                    'symbol' => 'Tk',
                    'name' => 'Bangladeshi Taka',
                    'decimal_digits' => '2',
                    'code' => 'BDT'
                ],
                [
                    'symbol' => 'BGN',
                    'name' => 'Bulgarian Lev',
                    'decimal_digits' => '2',
                    'code' => 'BGN'
                ],
                [
                    'symbol' => 'BD',
                    'name' => 'Bahraini Dinar',
                    'decimal_digits' => '3',
                    'code' => 'BHD'
                ],
                [
                    'symbol' => 'FBu',
                    'name' => 'Burundian Franc',
                    'decimal_digits' => '0',
                    'code' => 'BIF'
                ],
                [
                    'symbol' => 'BN$',
                    'name' => 'Brunei Dollar',
                    'decimal_digits' => '2',
                    'code' => 'BND'
                ],
                [
                    'symbol' => 'Bs',
                    'name' => 'Bolivian Boliviano',
                    'decimal_digits' => '2',
                    'code' => 'BOB'
                ],
                [
                    'symbol' => 'R$',
                    'name' => 'Brazilian Real',
                    'decimal_digits' => '2',
                    'code' => 'BRL'
                ],
                [
                    'symbol' => 'BWP',
                    'name' => 'Botswanan Pula',
                    'decimal_digits' => '2',
                    'code' => 'BWP'
                ],
                [
                    'symbol' => 'BYR',
                    'name' => 'Belarusian Ruble',
                    'decimal_digits' => '0',
                    'code' => 'BYR'
                ],
                [
                    'symbol' => 'BZ$',
                    'name' => 'Belize Dollar',
                    'decimal_digits' => '2',
                    'code' => 'BZD'
                ],
                [
                    'symbol' => 'CDF',
                    'name' => 'Congolese Franc',
                    'decimal_digits' => '2',
                    'code' => 'CDF'
                ],
                [
                    'symbol' => 'CHF',
                    'name' => 'Swiss Franc',
                    'decimal_digits' => '2',
                    'code' => 'CHF'
                ],
                [
                    'symbol' => 'CL$',
                    'name' => 'Chilean Peso',
                    'decimal_digits' => '0',
                    'code' => 'CLP'
                ],
                [
                    'symbol' => 'CN¥',
                    'name' => 'Chinese Yuan',
                    'decimal_digits' => '2',
                    'code' => 'CNY'
                ],
                [
                    'symbol' => 'CO$',
                    'name' => 'Colombian Peso',
                    'decimal_digits' => '0',
                    'code' => 'COP'
                ],
                [
                    'symbol' => '₡',
                    'name' => 'Costa Rican Colón',
                    'decimal_digits' => '0',
                    'code' => 'CRC'
                ],
                [
                    'symbol' => 'CV$',
                    'name' => 'Cape Verdean Escudo',
                    'decimal_digits' => '2',
                    'code' => 'CVE'
                ],
                [
                    'symbol' => 'Kč',
                    'name' => 'Czech Republic Koruna',
                    'decimal_digits' => '2',
                    'code' => 'CZK'
                ],
                [
                    'symbol' => 'Fdj',
                    'name' => 'Djiboutian Franc',
                    'decimal_digits' => '0',
                    'code' => 'DJF'
                ],
                [
                    'symbol' => 'Dkr',
                    'name' => 'Danish Krone',
                    'decimal_digits' => '2',
                    'code' => 'DKK'
                ],
                [
                    'symbol' => 'RD$',
                    'name' => 'Dominican Peso',
                    'decimal_digits' => '2',
                    'code' => 'DOP'
                ],
                [
                    'symbol' => 'DA',
                    'name' => 'Algerian Dinar',
                    'decimal_digits' => '2',
                    'code' => 'DZD'
                ],
                [
                    'symbol' => 'Ekr',
                    'name' => 'Estonian Kroon',
                    'decimal_digits' => '2',
                    'code' => 'EEK'
                ],
                [
                    'symbol' => 'EGP',
                    'name' => 'Egyptian Pound',
                    'decimal_digits' => '2',
                    'code' => 'EGP'
                ],
                [
                    'symbol' => 'Nfk',
                    'name' => 'Eritrean Nakfa',
                    'decimal_digits' => '2',
                    'code' => 'ERN'
                ],
                [
                    'symbol' => 'Br',
                    'name' => 'Ethiopian Birr',
                    'decimal_digits' => '2',
                    'code' => 'ETB'
                ],
                [
                    'symbol' => '£',
                    'name' => 'British Pound Sterling',
                    'decimal_digits' => '2',
                    'code' => 'GBP'
                ],
                [
                    'symbol' => 'GEL',
                    'name' => 'Georgian Lari',
                    'decimal_digits' => '2',
                    'code' => 'GEL'
                ],
                [
                    'symbol' => 'GH₵',
                    'name' => 'Ghanaian Cedi',
                    'decimal_digits' => '2',
                    'code' => 'GHS'
                ],
                [
                    'symbol' => 'FG',
                    'name' => 'Guinean Franc',
                    'decimal_digits' => '0',
                    'code' => 'GNF'
                ],
                [
                    'symbol' => 'GTQ',
                    'name' => 'Guatemalan Quetzal',
                    'decimal_digits' => '2',
                    'code' => 'GTQ'
                ],
                [
                    'symbol' => 'HK$',
                    'name' => 'Hong Kong Dollar',
                    'decimal_digits' => '2',
                    'code' => 'HKD'
                ],
                [
                    'symbol' => 'HNL',
                    'name' => 'Honduran Lempira',
                    'decimal_digits' => '2',
                    'code' => 'HNL'
                ],
                [
                    'symbol' => 'kn',
                    'name' => 'Croatian Kuna',
                    'decimal_digits' => '2',
                    'code' => 'HRK'
                ],
                [
                    'symbol' => 'Ft',
                    'name' => 'Hungarian Forint',
                    'decimal_digits' => '0',
                    'code' => 'HUF'
                ],
                [
                    'symbol' => 'Rp',
                    'name' => 'Indonesian Rupiah',
                    'decimal_digits' => '0',
                    'code' => 'IDR'
                ],
                [
                    'symbol' => '₪',
                    'name' => 'Israeli New Sheqel',
                    'decimal_digits' => '2',
                    'code' => 'ILS'
                ],
                [
                    'symbol' => 'Rs',
                    'name' => 'Indian Rupee',
                    'decimal_digits' => '2',
                    'code' => 'INR'
                ],
                [
                    'symbol' => 'IQD',
                    'name' => 'Iraqi Dinar',
                    'decimal_digits' => '0',
                    'code' => 'IQD'
                ],
                [
                    'symbol' => 'IRR',
                    'name' => 'Iranian Rial',
                    'decimal_digits' => '0',
                    'code' => 'IRR'
                ],
                [
                    'symbol' => 'Ikr',
                    'name' => 'Icelandic Króna',
                    'decimal_digits' => '0',
                    'code' => 'ISK'
                ],
                [
                    'symbol' => 'J$',
                    'name' => 'Jamaican Dollar',
                    'decimal_digits' => '2',
                    'code' => 'JMD'
                ],
                [
                    'symbol' => 'JD',
                    'name' => 'Jordanian Dinar',
                    'decimal_digits' => '3',
                    'code' => 'JOD'
                ],
                [
                    'symbol' => '¥',
                    'name' => 'Japanese Yen',
                    'decimal_digits' => '0',
                    'code' => 'JPY'
                ],
                [
                    'symbol' => 'Ksh',
                    'name' => 'Kenyan Shilling',
                    'decimal_digits' => '2',
                    'code' => 'KES'
                ],
                [
                    'symbol' => 'KHR',
                    'name' => 'Cambodian Riel',
                    'decimal_digits' => '2',
                    'code' => 'KHR'
                ],
                [
                    'symbol' => 'CF',
                    'name' => 'Comorian Franc',
                    'decimal_digits' => '0',
                    'code' => 'KMF'
                ],
                [
                    'symbol' => '₩',
                    'name' => 'South Korean Won',
                    'decimal_digits' => '0',
                    'code' => 'KRW'
                ],
                [
                    'symbol' => 'KD',
                    'name' => 'Kuwaiti Dinar',
                    'decimal_digits' => '3',
                    'code' => 'KWD'
                ],
                [
                    'symbol' => 'KZT',
                    'name' => 'Kazakhstani Tenge',
                    'decimal_digits' => '2',
                    'code' => 'KZT'
                ],
                [
                    'symbol' => 'LB£',
                    'name' => 'Lebanese Pound',
                    'decimal_digits' => '0',
                    'code' => 'LBP'
                ],
                [
                    'symbol' => 'SLRs',
                    'name' => 'Sri Lankan Rupee',
                    'decimal_digits' => '2',
                    'code' => 'LKR'
                ],
                [
                    'symbol' => 'Lt',
                    'name' => 'Lithuanian Litas',
                    'decimal_digits' => '2',
                    'code' => 'LTL'
                ],
                [
                    'symbol' => 'Ls',
                    'name' => 'Latvian Lats',
                    'decimal_digits' => '2',
                    'code' => 'LVL'
                ],
                [
                    'symbol' => 'LD',
                    'name' => 'Libyan Dinar',
                    'decimal_digits' => '3',
                    'code' => 'LYD'
                ],
                [
                    'symbol' => 'MAD',
                    'name' => 'Moroccan Dirham',
                    'decimal_digits' => '2',
                    'code' => 'MAD'
                ],
                [
                    'symbol' => 'MDL',
                    'name' => 'Moldovan Leu',
                    'decimal_digits' => '2',
                    'code' => 'MDL'
                ],
                [
                    'symbol' => 'MGA',
                    'name' => 'Malagasy Ariary',
                    'decimal_digits' => '0',
                    'code' => 'MGA'
                ],
                [
                    'symbol' => 'MKD',
                    'name' => 'Macedonian Denar',
                    'decimal_digits' => '2',
                    'code' => 'MKD'
                ],
                [
                    'symbol' => 'MMK',
                    'name' => 'Myanma Kyat',
                    'decimal_digits' => '0',
                    'code' => 'MMK'
                ],
                [
                    'symbol' => 'MOP$',
                    'name' => 'Macanese Pataca',
                    'decimal_digits' => '2',
                    'code' => 'MOP'
                ],
                [
                    'symbol' => 'MURs',
                    'name' => 'Mauritian Rupee',
                    'decimal_digits' => '0',
                    'code' => 'MUR'
                ],
                [
                    'symbol' => 'MX$',
                    'name' => 'Mexican Peso',
                    'decimal_digits' => '2',
                    'code' => 'MXN'
                ],
                [
                    'symbol' => 'RM',
                    'name' => 'Malaysian Ringgit',
                    'decimal_digits' => '2',
                    'code' => 'MYR'
                ],
                [
                    'symbol' => 'MTn',
                    'name' => 'Mozambican Metical',
                    'decimal_digits' => '2',
                    'code' => 'MZN'
                ],
                [
                    'symbol' => 'N$',
                    'name' => 'Namibian Dollar',
                    'decimal_digits' => '2',
                    'code' => 'NAD'
                ],
                [
                    'symbol' => '₦',
                    'name' => 'Nigerian Naira',
                    'decimal_digits' => '2',
                    'code' => 'NGN'
                ],
                [
                    'symbol' => 'C$',
                    'name' => 'Nicaraguan Córdoba',
                    'decimal_digits' => '2',
                    'code' => 'NIO'
                ],
                [
                    'symbol' => 'Nkr',
                    'name' => 'Norwegian Krone',
                    'decimal_digits' => '2',
                    'code' => 'NOK'
                ],
                [
                    'symbol' => 'NPRs',
                    'name' => 'Nepalese Rupee',
                    'decimal_digits' => '2',
                    'code' => 'NPR'
                ],
                [
                    'symbol' => 'NZ$',
                    'name' => 'New Zealand Dollar',
                    'decimal_digits' => '2',
                    'code' => 'NZD'
                ],
                [
                    'symbol' => 'OMR',
                    'name' => 'Omani Rial',
                    'decimal_digits' => '3',
                    'code' => 'OMR'
                ],
                [
                    'symbol' => 'B/.',
                    'name' => 'Panamanian Balboa',
                    'decimal_digits' => '2',
                    'code' => 'PAB'
                ],
                [
                    'symbol' => 'S/.',
                    'name' => 'Peruvian Nuevo Sol',
                    'decimal_digits' => '2',
                    'code' => 'PEN'
                ],
                [
                    'symbol' => '₱',
                    'name' => 'Philippine Peso',
                    'decimal_digits' => '2',
                    'code' => 'PHP'
                ],
                [
                    'symbol' => 'PKRs',
                    'name' => 'Pakistani Rupee',
                    'decimal_digits' => '0',
                    'code' => 'PKR'
                ],
                [
                    'symbol' => 'zł',
                    'name' => 'Polish Zloty',
                    'decimal_digits' => '2',
                    'code' => 'PLN'
                ],
                [
                    'symbol' => '₲',
                    'name' => 'Paraguayan Guarani',
                    'decimal_digits' => '0',
                    'code' => 'PYG'
                ],
                [
                    'symbol' => 'QR',
                    'name' => 'Qatari Rial',
                    'decimal_digits' => '2',
                    'code' => 'QAR'
                ],
                [
                    'symbol' => 'RON',
                    'name' => 'Romanian Leu',
                    'decimal_digits' => '2',
                    'code' => 'RON'
                ],
                [
                    'symbol' => 'din.',
                    'name' => 'Serbian Dinar',
                    'decimal_digits' => '0',
                    'code' => 'RSD'
                ],
                [
                    'symbol' => 'RUB',
                    'name' => 'Russian Ruble',
                    'decimal_digits' => '2',
                    'code' => 'RUB'
                ],
                [
                    'symbol' => 'RWF',
                    'name' => 'Rwandan Franc',
                    'decimal_digits' => '0',
                    'code' => 'RWF'
                ],
                [
                    'symbol' => 'SR',
                    'name' => 'Saudi Riyal',
                    'decimal_digits' => '2',
                    'code' => 'SAR'
                ],
                [
                    'symbol' => 'SDG',
                    'name' => 'Sudanese Pound',
                    'decimal_digits' => '2',
                    'code' => 'SDG'
                ],
                [
                    'symbol' => 'Skr',
                    'name' => 'Swedish Krona',
                    'decimal_digits' => '2',
                    'code' => 'SEK'
                ],
                [
                    'symbol' => 'S$',
                    'name' => 'Singapore Dollar',
                    'decimal_digits' => '2',
                    'code' => 'SGD'
                ],
                [
                    'symbol' => 'Ssh',
                    'name' => 'Somali Shilling',
                    'decimal_digits' => '0',
                    'code' => 'SOS'
                ],
                [
                    'symbol' => 'SY£',
                    'name' => 'Syrian Pound',
                    'decimal_digits' => '0',
                    'code' => 'SYP'
                ],
                [
                    'symbol' => '฿',
                    'name' => 'Thai Baht',
                    'decimal_digits' => '2',
                    'code' => 'THB'
                ],
                [
                    'symbol' => 'DT',
                    'name' => 'Tunisian Dinar',
                    'decimal_digits' => '3',
                    'code' => 'TND'
                ],
                [
                    'symbol' => 'T$',
                    'name' => 'Tongan Paʻanga',
                    'decimal_digits' => '2',
                    'code' => 'TOP'
                ],
                [
                    'symbol' => 'TL',
                    'name' => 'Turkish Lira',
                    'decimal_digits' => '2',
                    'code' => 'TRY'
                ],
                [
                    'symbol' => 'TT$',
                    'name' => 'Trinidad and Tobago Dollar',
                    'decimal_digits' => '2',
                    'code' => 'TTD'
                ],
                [
                    'symbol' => 'NT$',
                    'name' => 'New Taiwan Dollar',
                    'decimal_digits' => '2',
                    'code' => 'TWD'
                ],
                [
                    'symbol' => 'TSh',
                    'name' => 'Tanzanian Shilling',
                    'decimal_digits' => '0',
                    'code' => 'TZS'
                ],
                [
                    'symbol' => '₴',
                    'name' => 'Ukrainian Hryvnia',
                    'decimal_digits' => '2',
                    'code' => 'UAH'
                ],
                [
                    'symbol' => 'USh',
                    'name' => 'Ugandan Shilling',
                    'decimal_digits' => '0',
                    'code' => 'UGX'
                ],
                [
                    'symbol' => '$U',
                    'name' => 'Uruguayan Peso',
                    'decimal_digits' => '2',
                    'code' => 'UYU'
                ],
                [
                    'symbol' => 'UZS',
                    'name' => 'Uzbekistan Som',
                    'decimal_digits' => '0',
                    'code' => 'UZS'
                ],
                [
                    'symbol' => 'Bs.F.',
                    'name' => 'Venezuelan Bolívar',
                    'decimal_digits' => '2',
                    'code' => 'VEF'
                ],
                [
                    'symbol' => '₫',
                    'name' => 'Vietnamese Dong',
                    'decimal_digits' => '0',
                    'code' => 'VND'
                ],
                [
                    'symbol' => 'FCFA',
                    'name' => 'CFA Franc BEAC',
                    'decimal_digits' => '0',
                    'code' => 'XAF'
                ],
                [
                    'symbol' => 'CFA',
                    'name' => 'CFA Franc BCEAO',
                    'decimal_digits' => '0',
                    'code' => 'XOF'
                ],
                [
                    'symbol' => 'YR',
                    'name' => 'Yemeni Rial',
                    'decimal_digits' => '0',
                    'code' => 'YER'
                ],
                [
                    'symbol' => 'R',
                    'name' => 'South African Rand',
                    'decimal_digits' => '2',
                    'code' => 'ZAR'
                ],
                [
                    'symbol' => 'ZK',
                    'name' => 'Zambian Kwacha',
                    'decimal_digits' => '0',
                    'code' => 'ZMK'
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_currencies');
    }
}
