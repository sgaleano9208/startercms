<!doctype html>
<html lang="en">
        <head>
          <title>Reporte de Plan de Acción</title>
          <style>
            body{
              font-family: 'Poppins'; 
            }
            .container {
              max-width: 800px;
              margin: 0 auto;
              padding: 20px;
            }
            h1 {
              font-size: 36px;
              font-weight: bold;
              color: #212121;
            }
            p {
              margin-top: 20px;
            }
            p.bold {
              font-weight: bold;
            }
            p.normal {
              color: #212121;
            }
            table {
              width: 100%;
              margin-top: 20px;
              border-collapse: collapse;
            }
            td,
            th {
              padding: 10px;
            }
            th {
                background: #f5f5f5;
              font-weight: bold;
              text-align: left;
              color: #212121;
            }
            td {
              color: #212121;
            }
            tr {
              border-bottom: 1px solid #e0e0e0;
            }
          </style>
        </head>
        <body>
            <h1>{{$record->title}}</h1>
            <div>
              <p class="bold">Client:</p>
              <p class="normal">{{$record->client->name}}</p>
            </div>
            <div>
              <p class="bold">Notes:</p>
              {!! $record->note !!}
            </div>
            <div>
              <p class="bold">Date:</p>
              <p class="normal">{{ date_format($record->date, 'd/m/Y') }}</p>
            </div>
            <div>
              <p class="bold">Status:</p>
              <p class="normal">{{ucfirst($record->status)}}</p>
            </div>
            <table>
              <tr>
                <th>Product</th>
                <th>Current price</th>
                <th>Offer price</th>
              </tr>
              @foreach ($record->offer as $product)
              <tr>
                <td>{{ $product['productName'] }}</td>
                <td>{{ $product['currentPrice'] }}</td>
                <td>{{ $product['offerPrice'] }}</td>
              </tr>
              @endforeach
            </table>
        </body>
      </html>
      