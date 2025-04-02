<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class TicketController extends Controller
{
    public function index()
    {
        return view('boletos.index');
    }

    public function processPayment(Request $request)
    {
        $user = $request->user();

        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->addPaymentMethod($paymentMethod);

            $user->charge(1000, $paymentMethod); // Cobrar $10.00 USD (1000 centavos)

            return redirect()->route('checkout')->with('success', 'Pago realizado con éxito.');
        } catch (IncompletePayment $exception) {
            return redirect()->route('checkout')->with('error', 'El pago no se pudo completar.');
        }
    }
}
