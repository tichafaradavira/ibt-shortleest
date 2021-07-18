<template>
  <v-select  outlined :items="currencies" filled label="Currency">
    <template v-slot:item="{item}">
     <div> <span v-html="item.text" /> - <span>{{item.currency}}</span> </div>
    </template>
    <template v-slot:selection="{item}">
      <div> <span v-html="item.text" /> - <span>{{item.currency}}</span> </div>
    </template>
  </v-select>
</template>

<script>
export default {
  data: () => ({
    currencies: [
      {
        currency: "Albania Lek",
        value: "ALL",
        text: "&#76;&#101;&#107;"
      },
      {
        currency: "Afghanistan Afghani",
        value: "AFN",
        text: "&#1547;"
      },
      {
        currency: "Argentina Peso",
        value: "ARS",
        text: "&#36;"
      },
      {
        currency: "Aruba Guilder",
        value: "AWG",
        text: "&#402;"
      },
      {
        currency: "Australia Dollar",
        value: "AUD",
        text: "&#36;"
      },
      {
        currency: "Azerbaijan New Manat",
        value: "AZN",
        text: "&#1084;&#1072;&#1085;"
      },
      {
        currency: "Bahamas Dollar",
        value: "BSD",
        text: "&#36;"
      },
      {
        currency: "Barbados Dollar",
        value: "BBD",
        text: "&#36;"
      },
      {
        currency: "Belarus Ruble",
        value: "BYR",
        text: "&#112;&#46;"
      },
      {
        currency: "Belize Dollar",
        value: "BZD",
        text: "&#66;&#90;&#36;"
      },
      {
        currency: "Bermuda Dollar",
        value: "BMD",
        text: "&#36;"
      },
      {
        currency: "Bolivia Boliviano",
        value: "BOB",
        text: "&#36;&#98;"
      },
      {
        currency: "Bosnia and Herzegovina Convertible Marka",
        value: "BAM",
        text: "&#75;&#77;"
      },
      {
        currency: "Botswana Pula",
        value: "BWP",
        text: "&#80;"
      },
      {
        currency: "Bulgaria Lev",
        value: "BGN",
        text: "&#1083;&#1074;"
      },
      {
        currency: "Brazil Real",
        value: "BRL",
        text: "&#82;&#36;"
      },
      {
        currency: "Brunei Darussalam Dollar",
        value: "BND",
        text: "&#36;"
      },
      {
        currency: "Cambodia Riel",
        value: "KHR",
        text: "&#6107;"
      },
      {
        currency: "Canada Dollar",
        value: "CAD",
        text: "&#36;"
      },
      {
        currency: "Cayman Islands Dollar",
        value: "KYD",
        text: "&#36;"
      },
      {
        currency: "Chile Peso",
        value: "CLP",
        text: "&#36;"
      },
      {
        currency: "China Yuan Renminbi",
        value: "CNY",
        text: "&#165;"
      },
      {
        currency: "Colombia Peso",
        value: "COP",
        text: "&#36;"
      },
      {
        currency: "Costa Rica Colon",
        value: "CRC",
        text: "&#8353;"
      },
      {
        currency: "Croatia Kuna",
        value: "HRK",
        text: "&#107;&#110;"
      },
      {
        currency: "Cuba Peso",
        value: "CUP",
        text: "&#8369;"
      },
      {
        currency: "Czech Republic Koruna",
        value: "CZK",
        text: "&#75;&#269;"
      },
      {
        currency: "Denmark Krone",
        value: "DKK",
        text: "&#107;&#114;"
      },
      {
        currency: "Dominican Republic Peso",
        value: "DOP",
        text: "&#82;&#68;&#36;"
      },
      {
        currency: "East Caribbean Dollar",
        value: "XCD",
        text: "&#36;"
      },
      {
        currency: "Egypt Pound",
        value: "EGP",
        text: "&#163;"
      },
      {
        currency: "El Salvador Colon",
        value: "SVC",
        text: "&#36;"
      },
      {
        currency: "Estonia Kroon",
        value: "EEK",
        text: "&#107;&#114;"
      },
      {
        currency: "Euro Member Countries",
        value: "EUR",
        text: "&#8364;"
      },
      {
        currency: "Falkland Islands (Malvinas) Pound",
        value: "FKP",
        text: "&#163;"
      },
      {
        currency: "Fiji Dollar",
        value: "FJD",
        text: "&#36;"
      },
      {
        currency: "Ghana Cedis",
        value: "GHC",
        text: "&#162;"
      },
      {
        currency: "Gibraltar Pound",
        value: "GIP",
        text: "&#163;"
      },
      {
        currency: "Guatemala Quetzal",
        value: "GTQ",
        text: "&#81;"
      },
      {
        currency: "Guernsey Pound",
        value: "GGP",
        text: "&#163;"
      },
      {
        currency: "Guyana Dollar",
        value: "GYD",
        text: "&#36;"
      },
      {
        currency: "Honduras Lempira",
        value: "HNL",
        text: "&#76;"
      },
      {
        currency: "Hong Kong Dollar",
        value: "HKD",
        text: "&#36;"
      },
      {
        currency: "Hungary Forint",
        value: "HUF",
        text: "&#70;&#116;"
      },
      {
        currency: "Iceland Krona",
        value: "ISK",
        text: "&#107;&#114;"
      },
      {
        currency: "India Rupee",
        value: "INR",
        text: null
      },
      {
        currency: "Indonesia Rupiah",
        value: "IDR",
        text: "&#82;&#112;"
      },
      {
        currency: "Iran Rial",
        value: "IRR",
        text: "&#65020;"
      },
      {
        currency: "Isle of Man Pound",
        value: "IMP",
        text: "&#163;"
      },
      {
        currency: "Israel Shekel",
        value: "ILS",
        text: "&#8362;"
      },
      {
        currency: "Jamaica Dollar",
        value: "JMD",
        text: "&#74;&#36;"
      },
      {
        currency: "Japan Yen",
        value: "JPY",
        text: "&#165;"
      },
      {
        currency: "Jersey Pound",
        value: "JEP",
        text: "&#163;"
      },
      {
        currency: "Kazakhstan Tenge",
        value: "KZT",
        text: "&#1083;&#1074;"
      },
      {
        currency: "Korea (North) Won",
        value: "KPW",
        text: "&#8361;"
      },
      {
        currency: "Korea (South) Won",
        value: "KRW",
        text: "&#8361;"
      },
      {
        currency: "Kyrgyzstan Som",
        value: "KGS",
        text: "&#1083;&#1074;"
      },
      {
        currency: "Laos Kip",
        value: "LAK",
        text: "&#8365;"
      },
      {
        currency: "Latvia Lat",
        value: "LVL",
        text: "&#76;&#115;"
      },
      {
        currency: "Lebanon Pound",
        value: "LBP",
        text: "&#163;"
      },
      {
        currency: "Liberia Dollar",
        value: "LRD",
        text: "&#36;"
      },
      {
        currency: "Lithuania Litas",
        value: "LTL",
        text: "&#76;&#116;"
      },
      {
        currency: "Macedonia Denar",
        value: "MKD",
        text: "&#1076;&#1077;&#1085;"
      },
      {
        currency: "Malaysia Ringgit",
        value: "MYR",
        text: "&#82;&#77;"
      },
      {
        currency: "Mauritius Rupee",
        value: "MUR",
        text: "&#8360;"
      },
      {
        currency: "Mexico Peso",
        value: "MXN",
        text: "&#36;"
      },
      {
        currency: "Mongolia Tughrik",
        value: "MNT",
        text: "&#8366;"
      },
      {
        currency: "Mozambique Metical",
        value: "MZN",
        text: "&#77;&#84;"
      },
      {
        currency: "Namibia Dollar",
        value: "NAD",
        text: "&#36;"
      },
      {
        currency: "Nepal Rupee",
        value: "NPR",
        text: "&#8360;"
      },
      {
        currency: "Netherlands Antilles Guilder",
        value: "ANG",
        text: "&#402;"
      },
      {
        currency: "New Zealand Dollar",
        value: "NZD",
        text: "&#36;"
      },
      {
        currency: "Nicaragua Cordoba",
        value: "NIO",
        text: "&#67;&#36;"
      },
      {
        currency: "Nigeria Naira",
        value: "NGN",
        text: "&#8358;"
      },
      {
        currency: "Korea (North) Won",
        value: "KPW",
        text: "&#8361;"
      },
      {
        currency: "Norway Krone",
        value: "NOK",
        text: "&#107;&#114;"
      },
      {
        currency: "Oman Rial",
        value: "OMR",
        text: "&#65020;"
      },
      {
        currency: "Pakistan Rupee",
        value: "PKR",
        text: "&#8360;"
      },
      {
        currency: "Panama Balboa",
        value: "PAB",
        text: "&#66;&#47;&#46;"
      },
      {
        currency: "Paraguay Guarani",
        value: "PYG",
        text: "&#71;&#115;"
      },
      {
        currency: "Peru Nuevo Sol",
        value: "PEN",
        text: "&#83;&#47;&#46;"
      },
      {
        currency: "Philippines Peso",
        value: "PHP",
        text: "&#8369;"
      },
      {
        currency: "Poland Zloty",
        value: "PLN",
        text: "&#122;&#322;"
      },
      {
        currency: "Qatar Riyal",
        value: "QAR",
        text: "&#65020;"
      },
      {
        currency: "Romania New Leu",
        value: "RON",
        text: "&#108;&#101;&#105;"
      },
      {
        currency: "Russia Ruble",
        value: "RUB",
        text: "&#1088;&#1091;&#1073;"
      },
      {
        currency: "Saint Helena Pound",
        value: "SHP",
        text: "&#163;"
      },
      {
        currency: "Saudi Arabia Riyal",
        value: "SAR",
        text: "&#65020;"
      },
      {
        currency: "Serbia Dinar",
        value: "RSD",
        text: "&#1044;&#1080;&#1085;&#46;"
      },
      {
        currency: "Seychelles Rupee",
        value: "SCR",
        text: "&#8360;"
      },
      {
        currency: "Singapore Dollar",
        value: "SGD",
        text: "&#36;"
      },
      {
        currency: "Solomon Islands Dollar",
        value: "SBD",
        text: "&#36;"
      },
      {
        currency: "Somalia Shilling",
        value: "SOS",
        text: "&#83;"
      },
      {
        currency: "South Africa Rand",
        value: "ZAR",
        text: "&#82;"
      },
      {
        currency: "Korea (South) Won",
        value: "KRW",
        text: "&#8361;"
      },
      {
        currency: "Sri Lanka Rupee",
        value: "LKR",
        text: "&#8360;"
      },
      {
        currency: "Sweden Krona",
        value: "SEK",
        text: "&#107;&#114;"
      },
      {
        currency: "Switzerland Franc",
        value: "CHF",
        text: "&#67;&#72;&#70;"
      },
      {
        currency: "Suriname Dollar",
        value: "SRD",
        text: "&#36;"
      },
      {
        currency: "Syria Pound",
        value: "SYP",
        text: "&#163;"
      },
      {
        currency: "Taiwan New Dollar",
        value: "TWD",
        text: "&#78;&#84;&#36;"
      },
      {
        currency: "Thailand Baht",
        value: "THB",
        text: "&#3647;"
      },
      {
        currency: "Trinidad and Tobago Dollar",
        value: "TTD",
        text: "&#84;&#84;&#36;"
      },
      {
        currency: "Turkey Lira",
        value: "TRY",
        text: null
      },
      {
        currency: "Turkey Lira",
        value: "TRL",
        text: "&#8356;"
      },
      {
        currency: "Tuvalu Dollar",
        value: "TVD",
        text: "&#36;"
      },
      {
        currency: "Ukraine Hryvna",
        value: "UAH",
        text: "&#8372;"
      },
      {
        currency: "United Kingdom Pound",
        value: "GBP",
        text: "&#163;"
      },
      {
        currency: "United States Dollar",
        value: "USD",
        text: "&#36;"
      },
      {
        currency: "Uruguay Peso",
        value: "UYU",
        text: "&#36;&#85;"
      },
      {
        currency: "Uzbekistan Som",
        value: "UZS",
        text: "&#1083;&#1074;"
      },
      {
        currency: "Venezuela Bolivar",
        value: "VEF",
        text: "&#66;&#115;"
      },
      {
        currency: "Viet Nam Dong",
        value: "VND",
        text: "&#8363;"
      },
      {
        currency: "Yemen Rial",
        value: "YER",
        text: "&#65020;"
      },
      {
        currency: "Zimbabwe Dollar",
        value: "ZWD",
        text: "&#90;&#36;"
      }
    ]
  })
};
</script>
<style scoped>
</style>
