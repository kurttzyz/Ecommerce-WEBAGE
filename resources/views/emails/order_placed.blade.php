<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <tr>
            <td style="text-align: center; padding-bottom: 20px;">
                <h1 style="color: #4CAF50; margin: 0;">Thank you for your order!</h1>
                <p style="font-size: 16px; color: #555;">We're processing your order and will update you once it's shipped.</p>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="padding-top: 20px;">
                <h3 style="color: #333;">Ordered Items:</h3>
                <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f5f5f5;">
                            <th align="left" style="border-bottom: 1px solid #ddd;">Product</th>
                            <th align="right" style="border-bottom: 1px solid #ddd;">Price</th>
                            <th align="right" style="border-bottom: 1px solid #ddd;">Tax (2%)</th>
                            <th align="right" style="border-bottom: 1px solid #ddd;">Quantity</th>
                            <th align="right" style="border-bottom: 1px solid #ddd;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp

                        @foreach ($order->items as $item)
                            @php
                                $price = $item->product->regular_price;
                                $quantity = $item->quantity;
                                $subtotal = $price * $quantity;
                                $tax = $subtotal * 0.02; // 2% tax
                                $totalWithTax = $subtotal + $tax;
                                $grandTotal += $totalWithTax;
                            @endphp
                            <tr>
                                <td style="color: #333;">{{ $item->product->product_name }}</td>
                                <td align="right">₱{{ number_format($price, 2) }}</td>
                                <td align="right">₱{{ number_format($tax, 2) }}</td>
                                <td align="right">{{ $quantity }}</td>
                                <td align="right">₱{{ number_format($totalWithTax, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        
        <tr>
            <td colspan="2" align="right" style="padding-top: 15px; font-weight: bold; font-size: 16px;">
                Grand Total (incl. 2% tax): ₱{{ number_format($grandTotal, 2) }}
            </td>
        </tr>

        <tr>
            <td style="text-align: center; padding-top: 20px; border-top: 1px solid #eee;">
                <p style="font-size: 14px; color: #888;">Need help? Contact our support team at <a href="mailto:support@yourdomain.com" style="color: #4CAF50;">support@webage.com</a></p>
            </td>
        </tr>
    </table>
</body>
</html>
