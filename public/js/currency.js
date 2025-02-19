document.addEventListener("DOMContentLoaded", async function () {
    // Sets the rates to dummy rates and sets the symbols to match
    let rates = {"GBP":1,"USD":1.25,"EUR":1.20};
    let symbols = {"GBP":"£","USD":"$","EUR":"€"}
    
    // Function to get the rates from the exchange rate API
    async function getRates() {
        try{
            let api_data = await fetch("https://v6.exchangerate-api.com/v6/b40207b9b5744b46550475fb/latest/GBP")
            let data = await api_data.json();
            rates = data.conversion_rates;
            localStorage.setItem("rates", JSON.stringify(rates));
        } catch(error){
            console.log("Couldn't get currency rates",error);
        }
    }

    // Function to change the prices on the websites to match the currency selected
    async function changePrices(currency) {
        await getRates();
        if (rates === undefined){
            rates = {"GBP":1,"USD":1.25,"EUR":1.20}
        }


        document.querySelectorAll(".price,.product-price,.basket-price,.total").forEach(priceElement => {
            let gbpPrice = parseFloat(priceElement.getAttribute("data-gbp"));
            console.log(priceElement.getAttribute("class"));
            let updatedPrice = (gbpPrice * (rates[String(currency)])).toFixed(2);
            let symbol = symbols[currency];
            switch(priceElement.getAttribute("class")){
                case "price":
                    priceElement.innerText= `${symbol}${updatedPrice}`;
                    break;
                case "product-price":
                    priceElement.innerHTML= `from <span>${symbol}${updatedPrice}</span>`;
                    break;
                case "basket-price":
                    priceElement.innerText= `${symbol}${updatedPrice}`;
                    break;
                case "total":
                    priceElement.innerHTML= `Total: ${symbol}${updatedPrice}`;
                    break;
            }
        });

        localStorage.setItem("currency", currency);
    }

    // Function to call the price change for when a user changes it from the menu
    document.getElementById("currency-selector").addEventListener("change", function (){
        changePrices(this.value);
    });

    // Sets the saved choice so that the currency stays the same for all
    let savedChoice = localStorage.getItem("currency") || "GBP";
    document.getElementById("currency-selector").value = savedChoice;
    await changePrices(savedChoice);
});