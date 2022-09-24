<!DOCTYPE html>
<html>
<head>
    <title>Ads Mangement System</title>
    <style>
        .ads_table {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        .ads_table td, .ads_table th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        .ads_table tr:nth-child(even){background-color: #f2f2f2;}

        .ads_table tr:hover {background-color: #ddd;}

        .ads_table th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: center;
          background-color: #04AA6D;
          color: white;
        }
        .ads_table td{
            text-align: center;

        }

        </style>
</head>
<body>
    <h1>{{ $mData[0]['title'] }}</h1>

    Hi, {{ $mData[0]['advertiser'] }}

    <p>Here's all detail for your Ads</p>

    <table class="table ads_table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Type</th>
                <th scope="col">Category</th>
                <th scope="col">Tags</th>
                <th scope="col">Start Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mData as $k => $val)
            <tr>
                <td>{{ $k+1 }}</td>
                <td>{{ $val['ads_title'] }}</td>
                <td>{{ $val['ads_description'] }}</td>
                <td>{{ $val['ads_type'] }}</td>
                <td>{{ $val['ads_category'] }}</td>

                @if (is_array($val['ads_tags']))
                    <td>
                        <ul>
                            @foreach ($val['ads_tags'] as $val)
                                <li>{{ $val }}</li>
                            @endforeach
                        </ul>
                    </td>
                @else
                    <td>{{ $val['ads_tags'] }}</td>

                @endif
                <td>{{ $val }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <p>Thank you</p>

</body>
</html>
