<x-app-layout>
   <div class="container mx-auto">
        <form action="{{ route('event.store')}}" method="POST" id="form">
            @csrf
            <x-input-label value="Title"/>
            <x-text-input id="title" name="title" type="text" :value=" old('title')"/>

            <x-input-label for="content" value="Content"/>
            <textarea id="content" name="content"  :value=" old('content')" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>

            <x-input-label value="Premium"/>
            <x-text-input id="premium" name="premium" type="checkbox" :value=" old('premium')"/>

            <x-input-label value="Date Debu"/>
            <x-text-input id="starts_at" name="starts_at" type="date" :value=" old('starts_at')"/>

            <x-input-label value="Date fin"/>
            <x-text-input id="ends_at" name="ends_at" type="date" :value=" old('ends_at')"/>

            <x-input-label value="Tags :"/>
            <x-text-input id="tags" name="tags" type="text" :value=" old('tags')"/>


            <input type="hidden" id="payment_method" name="payment_method" />
            <div id="card-element">

            </div>
            <button type="submit" id="submit-button" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 my-2 px-4 rounded ">Creer Un Evenementt</button>
        </form>
   </div>


   @section('extra-js') 

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
         
            const elements = stripe.elements();
            const cardElement = elements.create('card',{
                classes:{
                    base:'StripeElement bg-white w-1/2 p-2 my-2 rounded-lg'
                }
            });
         
            cardElement.mount('#card-element');

            const cardButton = document.getElementById('submit-button')
            cardButton.addEventListner('click', async(e)=>{
                e.preventDefault();
                
                const {paymentMethod,error} = await stripe.createPaymentMethod('card',cardElement)

                if(error){
                    alert(error);
                }else{
                    document.getElementById('payment_method').value = paymentMethod.id;
                }

                document.getElementById('form').submit();
            })
        </script>

   @endsection
</x-app-layout>