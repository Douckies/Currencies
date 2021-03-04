import axios from "axios";
import { EventBus } from "@/eventBus.js";

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

  async postOrderCurrency(currencyToBuy) {
    await apiClient.post("/crypto/orderCurrency", currencyToBuy)
    .then( response => {
      if(response.status === 201) {
        EventBus.$emit("showSnackBar", {
          message: "Your order has been excecuted.",
          color: "success"
        })
      }
    })
    .catch(function (error) {
      if (error.response) {
        EventBus.$emit("showSnackBar", {
          message: "The server canno't properly treat the request :/.",
          color: "error"
        })
      } else if (error.request) {
        EventBus.$emit("showSnackBar", {
          message: "The server doesn't answer :'(.",
          color: "error"
        })
      } else {
        EventBus.$emit("showSnackBar", {
          message: "An unknown error has occured ><.",
          color: "error"
        })
      }
    })
  },

  async postInvestInExchange(investment) {
    await apiClient.post("/apport", investment)
    .then( response => {
      if(response.status === 201) {
        EventBus.$emit("showSnackBar", {
          message: "Your order has been excecuted.",
          color: "success"
        })
      }
    })
    .catch(function (error) {
      if (error.response) {
        EventBus.$emit("showSnackBar", {
          message: "The server canno't properly treat the request :/.",
          color: "error"
        })
      } else if (error.request) {
        EventBus.$emit("showSnackBar", {
          message: "The server doesn't answer :'(.",
          color: "error"
        })
      } else {
        EventBus.$emit("showSnackBar", {
          message: "An unknown error has occured ><.",
          color: "error"
        })
      }
    })
  },

  getHistory() {
    return apiClient.get("/history");
  },

  postHistory(order) {
    apiClient.post("/crypto/history", order)
  }
};