<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .page-break {
            page-break-before: always!important;
        }

        .avoid-break {
            page-break-inside: avoid!important;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2),
        td:nth-child(6) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
            width: 50%;
        }

        .invoice-box .links a {
            display: block;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: rgb(255, 127, 30);
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table td.photo {
            max-width: 120px;
        }

        .invoice-box table td.photo img {
            text-align: center;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .invoice-box table tr.total{
            background: rgb(255, 127, 30);
        }

        .footer {
            margin-top: 15px;
            padding: 5px;
            background-color: #eee;
            border: 2px solid #ddd
        }

        .footer ul {
            list-style: none;
            padding: 0px;
        }

        .legal {
            font-size: 11px;
            line-height: 1.1;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{asset('assets/logo.png')}}" style="width: 100%; max-width: 150px" />
                                <span style="display:block; font-weight: bold; font-size:18px">Industrial Starter S.L.U</span>
                            </td>

                            <td>
                                Invoice #: {{$data->number}}<br />
                                Created: {{date_format($data->date, 'd/m/Y')}}<br />
                                Due: February 1, 2015
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                <span style="font-weight: bold; font-size:18px">Contacto:</span><br />
                                Sparksuite, Inc.<br />
                                12345 Sunny Road<br />
                                Sunnyville, CA 12345
                            </td>

                            <td>
                                <span style="font-weight: bold; font-size:18px">Cliente:</span><br />
                                {{$client->name}}<br />
                                {{$client->phone}}<br />
                                {{$client->email}}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td class="photo">Photo</td>
                <td>Name</td>
                <td>Price</td>
                <td>Qty.</td>
                <td>Net price</td>
                <td>Total</td>
            </tr>
            @foreach ($proposalItems as $item)
            <tr class="item avoid-break">
                <td class="photo"><img src="{{asset($item->productVariation->product->photo)}}" style="width: 100%; max-width: 150px" />
                </td>
                <td>{{$item->name}}
                    <div class="links">
                        <a href="#">Link 1</a>
                        <a href="#">Link 1</a>
                    </div>
                </td>
                <td>{{$item->price}}€</td>
                <td>{{$item->quqntity}}</td>
                <td>$300.00</td>
                <td>$300.00</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="5"></td>

                <td>Total: $385.00</td>
            </tr>
        </table>
        <div class="page-break">
            <table cellpadding="0" cellspacing="0" class="footer">
                <tr>
                    <td>
                        <strong>Notas: </strong> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim tenetur
                        ullam tempora pariatur quibusdam vero numquam tempore similique veniam nemo, ad laborum
                        accusamus
                        illo placeat cupiditate eos ea. Repellendus, modi.
                    </td>
                </tr>
            </table>
            <table class="footer">
                <tr>
                    <td>
                        <strong>Condiciones de la oferta: </strong>
                        <ul>
                            <li>
                                <strong>Precio: </strong> unitario, impuestos y portes no incluidos adicionables según
                                condiciones
                                generales de nuestra tarifa en vigor
                            </li>
                            <li>
                                <strong>Forma de pago: </strong> Habitual
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div>
                foto de footer
            </div>
            <div class="legal">
                <strong>Aviso legal: </strong>
                <p>A través de este sitio web no se recaban datos de carácter personal de los usuarios sin su
                    conocimiento, ni se ceden a terceros. Con la finalidad de ofrecerle los mejores productos y
                    servicios y con el objeto de facilitar su uso, se analizan el número de páginas visitadas, el número
                    de visitas, así como la actividad de los visitantes y su frecuencia de utilización. A estos efectos,
                    INDUSTRIAL STARTER ESPAÑA, S.L. utiliza la información estadística elaborada por el Proveedor de
                    Servicios de Internet. INDUSTRIAL STARTER ESPAÑA, S.L. no utiliza cookies para recoger información
                    de los usuarios, ni registra las direcciones IP de acceso. Únicamente se utilizan cookies propias,
                    de sesión, con finalidad técnica (aquellas que permiten al usuario la navegación a través del sitio
                    web y la utilización de las diferentes opciones y servicios que en ella existen). El portal del que
                    es titular INDUSTRIAL STARTER ESPAÑA, S.L. contiene enlaces a sitios web de terceros, cuyas
                    políticas de privacidad son ajenas a la de INDUSTRIAL STARTER ESPAÑA, S.L.. Al acceder a tales
                    sitios web usted puede decidir si acepta sus políticas de privacidad y de cookies. Con carácter
                    general, si navega por internet usted puede aceptar o rechazar las cookies de terceros desde las
                    opciones de configuración de su navegador.</p>
            </div>
        </div>

    </div>
</body>

</html>
