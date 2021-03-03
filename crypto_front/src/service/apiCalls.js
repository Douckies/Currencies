import axios from "axios";

const apiClient = axios.create({
  baseURL: 'http://localhost:8080',
  withCredentials: false,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json"
  }
});

export default {
  getCurrenciesOwned() {
    return apiClient.get("/cryptos");
  },

  getInvestment() {
    return apiClient.get("/apport");
  },

  postBuyNewCurrency(currencyToBuy) {
    apiClient.post("/crypto/newCrypto", currencyToBuy)
  },

  postInvestInExchange(investment) {
    apiClient.post("/apport", investment)
  },

  postSellCurrency(currencyToSell) {
    apiClient.post("/crypto/sellCrypto", currencyToSell)
  }
};