<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DHLController extends Controller
{
    public function getSingleProductRate(Request $request)
    {
        // $client = new http\Client;
        // $request = new http\Client\Request;

        // $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/rates');
        // $request->setRequestMethod('GET');
        $headers = [
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ];

        $client = new Client([
            'headers' => $headers
        ]);

        $body = [
            'accountNumber' => 'SOME_STRING_VALUE',
            'originCountryCode' => 'SOME_STRING_VALUE',
            'originCityName' => 'SOME_STRING_VALUE',
            'destinationCountryCode' => 'SOME_STRING_VALUE',
            'destinationCityName' => 'SOME_STRING_VALUE',
            'weight' => 'SOME_NUMBER_VALUE',
            'length' => 'SOME_NUMBER_VALUE',
            'width' => 'SOME_NUMBER_VALUE',
            'height' => 'SOME_NUMBER_VALUE',
            'plannedShippingDate' => 'SOME_STRING_VALUE',
            'isCustomsDeclarable' => 'SOME_BOOLEAN_VALUE',
            'unitOfMeasurement' => 'SOME_STRING_VALUE'
        ];



        $r = $client->request('GET', 'https://express.api.dhl.com/mydhlapi/test/rates', [
            'body' => $body
        ]);

        $response = $r->getBody()->getContents();

        // $client->enqueue($request)->send();
        // $response = $client->getResponse();

        echo $response;

    }

    public function getMultiProductRate(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "customerDetails":{
                                "shipperDetails":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"addres1",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                },
                                "receiverDetails":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"addres1",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                }
                            },
                            "accounts":[
                                {
                                    "typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "productCode":"P",
                            "localProductCode":"P",
                            "valueAddedServices":[
                                {
                                    "serviceCode":"II",
                                    "localServiceCode":"II",
                                    "value":100,
                                    "currency":"GBP",
                                    "method":"cash"
                                }
                            ],
                            "productsAndServices":[
                                {
                                    "productCode":"P",
                                    "localProductCode":"P",
                                    "valueAddedServices":[
                                        {
                                            "serviceCode":"II",
                                            "localServiceCode":"II",
                                            "value":100,
                                            "currency":"GBP",
                                            "method":"cash"
                                        }
                                    ]
                                }
                            ],
                            "payerCountryCode":"CZ",
                            "plannedShippingDateAndTime":"2020-03-24T13:00:00GMT+00:00",
                            "unitOfMeasurement":"metric",
                            "isCustomsDeclarable":false,
                            "monetaryAmount":[
                                {
                                    "typeCode":"declaredValue",
                                    "value":100,
                                    "currency":"CZK"
                                }
                            ],
                            "requestAllValueAddedServices":false,
                            "estimatedDeliveryDate":{
                                "isRequested":false,
                                "typeCode":"QDDC"
                            },
                            "getAdditionalInformation":[
                                {
                                    "typeCode":"allValueAddedServices",
                                    "isRequested":true
                                }
                            ],
                            "returnStandardProductsOnly":false,
                            "nextBusinessDay":false,
                            "productTypeCode":"all",
                            "packages":[
                                {
                                    "typeCode":"3BX",
                                    "weight":10.5,
                                    "dimensions":{
                                        "length":25,
                                        "width":35,
                                        "height":15
                                    }
                                }
                            ]
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/rates');
        $request->setRequestMethod('POST');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function getLandedCast(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "customerDetails":{
                                "shipperDetails":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"addres1",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                },
                                "receiverDetails":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"addres1",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                }
                            },
                            "accounts":[
                                {
                                    "typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "productCode":"P",
                            "localProductCode":"P",
                            "unitOfMeasurement":"metric",
                            "currencyCode":"CZK",
                            "isCustomsDeclarable":true,
                            "isDTPRequested":true,
                            "isInsuranceRequested":false,
                            "getCostBreakdown":true,
                            "charges":[
                                {
                                    "typeCode":"insurance",
                                    "amount":1250,
                                    "currencyCode":"CZK"
                                }
                            ],
                            "shipmentPurpose":"personal",
                            "transportationMode":"air",
                            "merchantSelectedCarrierName":"DHL",
                            "packages":[
                                {
                                    "typeCode":"3BX",
                                    "weight":10.5,
                                    "dimensions":{
                                        "length":25,
                                        "width":35,
                                        "height":15
                                    }
                                }
                            ],
                            "items":[
                                {
                                    "number":1,
                                    "name":"KNITWEAR COTTON",
                                    "description":"KNITWEAR 100% COTTON REDUCTION PRICE FALL COLLECTION",
                                    "manufacturerCountry":"CN",
                                    "partNumber":"12345555",
                                    "quantity":2,
                                    "quantityType":"prt",
                                    "unitPrice":120,
                                    "unitPriceCurrencyCode":"EUR",
                                    "customsValue":120,
                                    "customsValueCurrencyCode":"EUR",
                                    "commodityCode":"6110129090",
                                    "weight":5,
                                    "weightUnitOfMeasurement":"metric",
                                    "category":"204",
                                    "brand":"SHOE 1",
                                    "goodsCharacteristics":[
                                        {
                                            "typeCode":"IMPORTER",
                                            "value":"Registered"
                                        }
                                    ],
                                    "additionalQuantityDefinitions":[
                                        {
                                            "typeCode":"DPR",
                                            "amount":2
                                        }
                                    ],
                                    "estimatedTariffRateType":"default_rate"
                                }
                            ],
                            "getTariffFormula":true,
                            "getQuotationID":true
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/landed-cost');
        $request->setRequestMethod('POST');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function getDhlAvailableServices(Request $request)
    {
        dd($request);
        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/products');
        $request->setRequestMethod('GET');
        $request->setQuery(new http\QueryString([
            'accountNumber' => 'SOME_STRING_VALUE',
            'originCountryCode' => 'SOME_STRING_VALUE',
            'originCityName' => 'SOME_STRING_VALUE',
            'destinationCountryCode' => 'SOME_STRING_VALUE',
            'destinationCityName' => 'SOME_STRING_VALUE',
            'weight' => 'SOME_NUMBER_VALUE',
            'length' => 'SOME_NUMBER_VALUE',
            'width' => 'SOME_NUMBER_VALUE',
            'height' => 'SOME_NUMBER_VALUE',
            'plannedShippingDate' => 'SOME_STRING_VALUE',
            'isCustomsDeclarable' => 'SOME_BOOLEAN_VALUE',
            'unitOfMeasurement' => 'SOME_STRING_VALUE'
        ]));

        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function electronicProofDelivery(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/shipments/1234567890/proof-of-delivery');
        $request->setRequestMethod('GET');
        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();
        echo $response->getBody();
    }

    public function updatePaperlessTrade(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "shipmentTrackingNumber":"123456790",
                            "originalPlannedShippingDate":"2020-04-20",
                            "accounts":[
                                {
                                    "typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "productCode":"D",
                            "documentImages":[
                                {
                                    "typeCode":"INV",
                                    "imageFormat":"PDF",
                                    "content":"base64 encoded image"
                                }
                            ]
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/shipments/1234567890/upload-image');
        $request->setRequestMethod('PATCH');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function createShipment(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "plannedShippingDateAndTime":"2019-08-04T14:00:31GMT+01:00",
                            "pickup":{
                                "isRequested":false,
                                "closeTime":"18:00",
                                "location":"reception",
                                "specialInstructions":[
                                    {
                                        "value":"please ring door bell",
                                        "typeCode":"TBD"
                                    }
                                ],
                                "pickupDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "pickupRequestorDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                }
                            },
                            "productCode":"D",
                            "localProductCode":"D",
                            "getRateEstimates":false,
                            "accounts":[
                                {
                                    "typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "valueAddedServices":[
                                {
                                    "serviceCode":"II",
                                    "value":100,
                                    "currency":"GBP",
                                    "method":"cash",
                                    "dangerousGoods":[
                                        {
                                            "contentId":"908",
                                            "dryIceTotalNetWeight":12,
                                            "unCode":"UN-7843268473",
                                            "customDescription":"1 package Lithium ion batteries in compliance with Section II of P.I. 9661"
                                        }
                                    ]
                                }
                            ],
                            "outputImageProperties":{
                                "printerDPI":300,
                                "customerBarcodes":[
                                    {
                                        "content":"barcode content",
                                        "textBelowBarcode":"text below barcode",
                                        "symbologyCode":"93"
                                    }
                                ],
                                "customerLogos":[
                                    {
                                        "fileFormat":"PNG",
                                        "content":"base64 encoded image"
                                    }
                                ],
                                "encodingFormat":"pdf",
                                "imageOptions":[
                                    {
                                        "typeCode":"label",
                                        "templateName":"ECOM26_84_001",
                                        "isRequested":true,
                                        "hideAccountNumber":false,
                                        "numberOfCopies":1,
                                        "invoiceType":"commercial",
                                        "languageCode":"eng",
                                        "languageCountryCode":"br",
                                        "encodingFormat":"png",
                                        "renderDHLLogo":false,
                                        "fitLabelsToA4":false,
                                        "labelFreeText":"string",
                                        "labelCustomerDataText":"string"
                                    }
                                ],
                                "splitTransportAndWaybillDocLabels":true,
                                "allDocumentsInOneImage":true,
                                "splitDocumentsByPages":true,
                                "splitInvoiceAndReceipt":true,
                                "receiptAndLabelsInOneImage":true
                            },
                            "customerReferences":[
                                {
                                    "value":"Customer reference",
                                    "typeCode":"CU"
                                }
                            ],
                            "identifiers":[
                                {
                                    "typeCode":"shipmentId",
                                    "value":"1234567890",
                                    "dataIdentifier":"00"
                                }
                            ],
                            "customerDetails":{
                                "shipperDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "receiverDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "buyerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"buyer@domain.com",
                                        "phone":"+44123456789",
                                        "mobilePhone":"+42123456789",
                                        "companyName":"Customer Company Name",
                                        "fullName":"Mark Companer"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "importerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "exporterDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "sellerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "payerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":[
                                        {
                                            "name":"Russian Bank Name",
                                            "settlementLocalCurrency":"RUB",
                                            "settlementForeignCurrency":"USD"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "ultimateConsigneeDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia",
                                        "provinceName":"Central Bohemia",
                                        "countryName":"Czech Republic"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "bankDetails":{
                                        "typeCode":"VAT",
                                        "number":"CZ123456789",
                                        "issuerCountryCode":"CZ"
                                    },
                                    "typeCode":"string"
                                }
                            },
                            "content":{
                                "packages":[
                                    {
                                        "typeCode":"2BP",
                                        "weight":22.501,
                                        "dimensions":{
                                            "length":15.001,
                                            "width":15.001,
                                            "height":40.001
                                        },
                                        "customerReferences":[
                                            {
                                                "value":"Customer reference",
                                                "typeCode":"CU"
                                            }
                                        ],
                                        "identifiers":[
                                            {
                                                "typeCode":"shipmentId",
                                                "value":"1234567890",
                                                "dataIdentifier":"00"
                                            }
                                        ],
                                        "description":"Piece content description",
                                        "labelBarcodes":[
                                            {
                                                "position":"left",
                                                "symbologyCode":"93",
                                                "content":"string",
                                                "textBelowBarcode":"text below left barcode"
                                            }
                                        ],
                                        "labelText":[
                                            {
                                                "position":"left",
                                                "caption":"text caption",
                                                "value":"text value"
                                            }
                                        ],
                                        "labelDescription":"bespoke label description"
                                    }
                                ],
                                "isCustomsDeclarable":true,
                                "declaredValue":150,
                                "declaredValueCurrency":"CZK",
                                "exportDeclaration":{
                                    "lineItems":[
                                        {
                                            "number":1,
                                            "description":"line item description",
                                            "price":150,
                                            "quantity":{
                                                "value":1,
                                                "unitOfMeasurement":"BOX"
                                            },
                                            "commodityCodes":[
                                                {
                                                    "typeCode":"outbound",
                                                    "value":"HS1234567890"
                                                }
                                            ],
                                            "exportReasonType":"permanent",
                                            "manufacturerCountry":"CZ",
                                            "exportControlClassificationNumber":"US123456789",
                                            "weight":{
                                                "netValue":10,
                                                "grossValue":10
                                            },
                                            "isTaxesPaid":true,
                                            "additionalInformation":["string"],
                                            "customerReferences":[
                                                {
                                                    "typeCode":"AFE",
                                                    "value":"custref123"
                                                }
                                            ],
                                            "customsDocuments":[
                                                {
                                                    "typeCode":"972",
                                                    "value":"custdoc456"
                                                }
                                            ]
                                        }
                                    ],
                                    "invoice":{
                                        "number":"12345-ABC",
                                        "date":"2020-03-18",
                                        "signatureName":"Brewer",
                                        "signatureTitle":"Mr.",
                                        "signatureImage":"Base64 encoded image",
                                        "instructions":["string"],
                                        "customerDataTextEntries":["string"],
                                        "totalNetWeight":999999999999,
                                        "totalGrossWeight":999999999999,
                                        "customerReferences":[
                                            {
                                                "typeCode":"CU",
                                                "value":"custref112"
                                            }
                                        ],
                                        "termsOfPayment":"100 days",
                                        "indicativeCustomsValues":{
                                            "importCustomsDutyValue":150.57,
                                            "importTaxesValue":49.43
                                        }
                                    },
                                    "remarks":[
                                        {
                                            "value":"declaration remark"
                                        }
                                    ],
                                    "additionalCharges":[
                                        {
                                            "value":10,
                                            "caption":"fee",
                                            "typeCode":"freight"
                                        }
                                    ],
                                    "destinationPortName":"port details",
                                    "placeOfIncoterm":"port of departure or destination details",
                                    "payerVATNumber":"12345ED",
                                    "recipientReference":"recipient reference",
                                    "exporter":{
                                        "id":"123",
                                        "code":"EXPCZ"
                                    },
                                    "packageMarks":"marks",
                                    "declarationNotes":[
                                        {
                                            "value":"up to three declaration notes"
                                        }
                                    ],
                                    "exportReference":"export reference",
                                    "exportReason":"export reason",
                                    "exportReasonType":"permanent",
                                    "licenses":[
                                        {
                                            "typeCode":"export",
                                            "value":"license"
                                        }
                                    ],
                                    "shipmentType":"personal",
                                    "customsDocuments":[
                                        {
                                            "typeCode":"972",
                                            "value":"custdoc445"
                                        }
                                    ]
                                },
                                "description":"shipment description",
                                "USFilingTypeValue":"12345",
                                "incoterm":"DAP",
                                "unitOfMeasurement":"metric"
                            },
                            "documentImages":[
                                {
                                    "typeCode":"INV",
                                    "imageFormat":"PDF",
                                    "content":"base64 encoded image"
                                }
                            ],
                            "onDemandDelivery":{
                                "deliveryOption":"servicepoint",
                                "location":"front door",
                                "specialInstructions":"ringe twice",
                                "gateCode":"1234",
                                "whereToLeave":"concierge",
                                "neighbourName":"Mr.Dan",
                                "neighbourHouseNumber":"777",
                                "authorizerName":"Newman",
                                "servicePointId":"SPL123",
                                "requestedDeliveryDate":"2020-04-20"
                            },
                            "requestOndemandDeliveryURL":false,
                            "shipmentNotification":[
                                {
                                    "typeCode":"email",
                                    "receiverId":"receiver@email.com",
                                    "languageCode":"eng",
                                    "languageCountryCode":"UK",
                                    "bespokeMessage":"message to be included in the notification"
                                }
                            ],
                            "prepaidCharges":[
                                {
                                    "typeCode":"freight",
                                    "currency":"CZK",
                                    "value":200,
                                    "method":"cash"
                                }
                            ],
                            "getTransliteratedResponse":false,
                            "estimatedDeliveryDate":{
                                "isRequested":false,
                                "typeCode":"QDDC"
                            },
                            "getAdditionalInformation":[
                                {
                                    "typeCode":"pickupDetails",
                                    "isRequested":true
                                }
                            ],
                            "parentShipment":{
                                "productCode":"s",
                                "packagesCount":1
                            }
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/shipments');
        $request->setRequestMethod('POST');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function uploadCommercialInvoice(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "plannedShipDate":"2020-04-20",
                            "accounts":[
                                {"typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "content":{
                                "exportDeclaration":[
                                    {
                                        "lineItems":[
                                            {
                                                "number":1,
                                                "description":"line item description",
                                                "price":150,
                                                "quantity":
                                                {
                                                    "value":1,
                                                    "unitOfMeasurement":"BOX"
                                                },
                                                "commodityCodes":[
                                                    {
                                                        "typeCode":"outbound",
                                                        "value":"HS1234567890"
                                                    }
                                                ],
                                                "exportReasonType":"permanent",
                                                "manufacturerCountry":"CZ",
                                                "weight":{
                                                    "netValue":10,
                                                    "grossValue":10
                                                },
                                                "isTaxesPaid":true,
                                                "customerReferences":[
                                                    {
                                                        "typeCode":"AFE",
                                                        "value":"customerref1"
                                                    }
                                                ],
                                                "customsDocuments":[
                                                    {
                                                        "typeCode":"972",
                                                        "value":"custdoc456"
                                                    }
                                                ]
                                            }
                                        ],
                                        "invoice":{
                                            "number":"12345-ABC",
                                            "date":"2021-03-18",
                                            "function":"import",
                                            "customerReferences":[
                                                {
                                                    "typeCode":"CU",
                                                    "value":"custref112"
                                                }
                                            ]
                                        },
                                        "remarks":[
                                            {
                                                "value":"declaration remark"
                                            }
                                        ],
                                        "additionalCharges":[
                                            {
                                                "value":10,
                                                "typeCode":"admin"
                                            }
                                        ],
                                        "placeOfIncoterm":"port of departure or destination details",
                                        "recipientReference":"recipient reference",
                                        "exporter":{
                                            "id":"123",
                                            "code":"EXPCZ"
                                        },
                                        "exportReasonType":"permanent",
                                        "shipmentType":"personal",
                                        "customsDocuments":[
                                            {
                                                "typeCode":"972",
                                                "value":"custdoc445"
                                            }
                                        ],
                                        "incoterm":"DAP"
                                    }
                                ],
                                "currency":"EUR",
                                "unitOfMeasurement":"metric"
                            },
                            "outputImageProperties":{
                                "imageOptions":[
                                    {
                                        "typeCode":"invoice",
                                        "templateName":"COMMERCIAL_INVOICE_P_10",
                                        "isRequested":true
                                    }
                                ]
                            },
                            "customerDetails":{
                                "sellerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "typeCode":"business",
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ]
                                },
                                "buyerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "importerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "exporterDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "ultimateConsigneeDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "typeCode":"business",
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ]
                                }
                            }
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/shipments/1234567890/upload-invoice-data');
        $request->setRequestMethod('PATCH');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function getImage(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/shipments/1234567890/get-image');
        $request->setRequestMethod('GET');
        $request->setQuery(new http\QueryString([
            'shipperAccountNumber' => 'SOME_STRING_VALUE',
            'typeCode' => 'SOME_STRING_VALUE',
            'pickupYearAndMonth' => 'YYYY-MM'
        ]));

        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function trackSingleShipment(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/shipments/1234567890/tracking');
        $request->setRequestMethod('GET');
        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function trackMultipleShipment(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/tracking');
        $request->setRequestMethod('GET');
        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function cancelDhlBookingRequest(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/pickups/PRG999126012345');
        $request->setRequestMethod('DELETE');
        $request->setQuery(new http\QueryString([
            'requestorName' => 'SOME_STRING_VALUE',
            'reason' => 'SOME_STRING_VALUE'
        ]));

        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function updateExistingPickup(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "dispatchConfirmationNumber":"CBJ201220123456",
                            "originalShipperAccountNumber":"123456789",
                            "plannedPickupDateAndTime":"2019-08-04T14:00:31GMT+01:00",
                            "closeTime":"18:00",
                            "location":"reception",
                            "locationType":"residence",
                            "accounts":[
                                {
                                    "typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "specialInstructions":[
                                {
                                    "value":"please ring door bell",
                                    "typeCode":"TBD"
                                }
                            ],
                            "remark":"string",
                            "customerDetails":{
                                "shipperDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    }
                                },
                                "receiverDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    }
                                },
                                "bookingRequestorDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    }
                                },
                                "pickupDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    }
                                }
                            },
                            "shipmentDetails":[
                                {
                                    "productCode":"D",
                                    "localProductCode":"D",
                                    "accounts":[
                                        {
                                            "typeCode":"shipper",
                                            "number":"123456789"
                                        }
                                    ],
                                    "valueAddedServices":[
                                        {
                                            "serviceCode":"II",
                                            "localServiceCode":"II",
                                            "value":100,
                                            "currency":"GBP",
                                            "method":"cash"
                                        }
                                    ],
                                    "isCustomsDeclarable":true,
                                    "declaredValue":150,
                                    "declaredValueCurrency":"CZK",
                                    "unitOfMeasurement":"metric",
                                    "shipmentTrackingNumber":"123456790",
                                    "packages":[
                                        {
                                            "typeCode":"3BX",
                                            "weight":10.5,
                                            "dimensions":{
                                                "length":25,
                                                "width":35,
                                                "height":15
                                            }
                                        }
                                    ]
                                }
                            ]
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/pickups/PRG999126012345');
        $request->setRequestMethod('PATCH');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function createDhlPickup(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('{
                        "plannedPickupDateAndTime":"2019-08-04T14:00:31GMT+01:00",
                        "closeTime":"18:00",
                        "location":"reception",
                        "locationType":"residence",
                        "accounts":[
                            {
                                "typeCode":"shipper",
                                "number":"123456789"
                            }
                        ],
                        "specialInstructions":[
                            {
                                "value":"please ring door bell",
                                "typeCode":"TBD"
                            }
                        ],
                        "remark":"string",
                        "customerDetails":{
                            "shipperDetails":{
                                "postalAddress":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"V Parku 2308/10",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                },
                                "contactInformation":{
                                    "email":"that@before.de",
                                    "phone":"+1123456789",
                                    "mobilePhone":"+60112345678",
                                    "companyName":"Company Name",
                                    "fullName":"John Brew"
                                }
                            },
                            "receiverDetails":{
                                "postalAddress":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"V Parku 2308/10",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                },
                                "contactInformation":{
                                    "email":"that@before.de",
                                    "phone":"+1123456789",
                                    "mobilePhone":"+60112345678",
                                    "companyName":"Company Name",
                                    "fullName":"John Brew"
                                }
                            },
                            "bookingRequestorDetails":{
                                "postalAddress":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"V Parku 2308/10",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                },
                                "contactInformation":{
                                    "email":"that@before.de",
                                    "phone":"+1123456789",
                                    "mobilePhone":"+60112345678",
                                    "companyName":"Company Name",
                                    "fullName":"John Brew"
                                }
                            },
                            "pickupDetails":{
                                "postalAddress":{
                                    "postalCode":"14800",
                                    "cityName":"Prague",
                                    "countryCode":"CZ",
                                    "provinceCode":"CZ",
                                    "addressLine1":"V Parku 2308/10",
                                    "addressLine2":"addres2",
                                    "addressLine3":"addres3",
                                    "countyName":"Central Bohemia"
                                },
                                "contactInformation":{
                                    "email":"that@before.de",
                                    "phone":"+1123456789",
                                    "mobilePhone":"+60112345678",
                                    "companyName":"Company Name",
                                    "fullName":"John Brew"
                                }
                            }
                        },
                        "shipmentDetails":[
                            {
                                "productCode":"string",
                                "localProductCode":"str",
                                "accounts":[
                                    {
                                        "typeCode":"shipper",
                                        "number":"123456789"
                                    }
                                ],
                                "valueAddedServices":[
                                    {
                                        "serviceCode":"II",
                                        "localServiceCode":"II",
                                        "value":100,
                                        "currency":"GBP",
                                        "method":"cash"
                                    }
                                ],
                                "isCustomsDeclarable":true,
                                "declaredValue":150,
                                "declaredValueCurrency":"CZK",
                                "unitOfMeasurement":"metric",
                                "shipmentTrackingNumber":"123456790",
                                "packages":[
                                    {
                                        "typeCode":"3BX",
                                        "weight":10.5,
                                        "dimensions":{
                                            "length":25,
                                            "width":35,
                                            "height":15
                                        }
                                    }
                                ]
                            }
                        ]
                    }'
                );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/pickups');
        $request->setRequestMethod('POST');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function validatePickupAddress(Request $request)
    {
        dd($request);

        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/address-validate');
        $request->setRequestMethod('GET');
        $request->setQuery(new http\QueryString([

            'type' => 'SOME_STRING_VALUE',
            'countryCode' => 'SOME_STRING_VALUE'

        ]));

        $request->setHeaders([
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();
    }

    public function uploadCommercialInvoiceData(Request $request)
    {
        dd($request);
        $client = new http\Client;
        $request = new http\Client\Request;

        $body = new http\Message\Body;
        $body->append('
                        {
                            "shipmentTrackingNumber":"123456790",
                            "plannedShipDate":"2020-04-20",
                            "accounts":[
                                {
                                    "typeCode":"shipper",
                                    "number":"123456789"
                                }
                            ],
                            "content":{
                                "exportDeclaration":[
                                    {
                                        "lineItems":[
                                            {
                                                "number":1,
                                                "description":"line item description",
                                                "price":150,
                                                "quantity":{
                                                    "value":1,
                                                    "unitOfMeasurement":"BOX"
                                                },
                                                "commodityCodes":[
                                                    {
                                                        "typeCode":"outbound",
                                                        "value":"HS1234567890"
                                                    }
                                                ],
                                                "exportReasonType":"permanent",
                                                "manufacturerCountry":"CZ",
                                                "weight":{
                                                    "netValue":10,
                                                    "grossValue":10
                                                },
                                                "isTaxesPaid":true,
                                                "customerReferences":[
                                                    {
                                                        "typeCode":"AFE",
                                                        "value":"customerref1"
                                                    }
                                                ],
                                                "customsDocuments":[
                                                    {
                                                        "typeCode":"972",
                                                        "value":"custdoc456"
                                                    }
                                                ]
                                            }
                                        ],
                                        "invoice":{
                                            "number":"12345-ABC",
                                            "date":"2021-03-18",
                                            "function":"import",
                                            "customerReferences":[
                                                {
                                                    "typeCode":"CU",
                                                    "value":"custref112"
                                                }
                                            ]
                                        },
                                        "remarks":[
                                            {
                                                "value":"declaration remark"
                                            }
                                        ],
                                        "additionalCharges":[
                                            {
                                                "value":10,
                                                "typeCode":"admin"
                                            }
                                        ],
                                        "placeOfIncoterm":"port of departure or destination details",
                                        "recipientReference":"recipient reference",
                                        "exporter":{
                                            "id":"123",
                                            "code":"EXPCZ"
                                        },
                                        "exportReasonType":"permanent",
                                        "shipmentType":"personal",
                                        "customsDocuments":[
                                            {
                                                "typeCode":"972",
                                                "value":"custdoc445"
                                            }
                                        ],
                                        "incoterm":"DAP"
                                    }
                                ],
                                "currency":"EUR",
                                "unitOfMeasurement":"metric"
                            },
                            "outputImageProperties":{
                                "imageOptions":[
                                    {
                                        "typeCode":"invoice",
                                        "templateName":"COMMERCIAL_INVOICE_P_10",
                                        "isRequested":true
                                    }
                                ]
                            },
                            "customerDetails":{
                                "sellerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "typeCode":"business",
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ]
                                },
                                "buyerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "importerDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "exporterDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ],
                                    "typeCode":"business"
                                },
                                "ultimateConsigneeDetails":{
                                    "postalAddress":{
                                        "postalCode":"14800",
                                        "cityName":"Prague",
                                        "countryCode":"CZ",
                                        "provinceCode":"CZ",
                                        "addressLine1":"V Parku 2308/10",
                                        "addressLine2":"addres2",
                                        "addressLine3":"addres3",
                                        "countyName":"Central Bohemia"
                                    },
                                    "contactInformation":{
                                        "email":"that@before.de",
                                        "phone":"+1123456789",
                                        "mobilePhone":"+60112345678",
                                        "companyName":"Company Name",
                                        "fullName":"John Brew"
                                    },
                                    "typeCode":"business",
                                    "registrationNumbers":[
                                        {
                                            "typeCode":"VAT",
                                            "number":"CZ123456789",
                                            "issuerCountryCode":"CZ"
                                        }
                                    ]
                                }
                            }
                        }'
                    );

        $request->setRequestUrl('https://express.api.dhl.com/mydhlapi/test/invoices/upload-invoice-data');
        $request->setRequestMethod('POST');
        $request->setBody($body);

        $request->setHeaders([
            'content-type' => 'application/json',
            'Authorization' => 'Basic REPLACE_BASIC_AUTH'
        ]);

        $client->enqueue($request)->send();
        $response = $client->getResponse();
        echo $response->getBody();
    }
}
