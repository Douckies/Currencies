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
  getCrypto() {
    return apiClient.get("/crypto");
  },

  getApport() {
    return apiClient.get("/apport");
  },

  postAchatCrypto(crypto) {
    apiClient.post("/crypto", crypto)
  },

  postApport(apport) {
    apiClient.post("/apport", apport)
    console.log('api : '+apport)
  }
};