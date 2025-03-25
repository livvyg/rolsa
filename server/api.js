const express = require("express");
const axios = require("axios");
const cors = require("cors");

const app = express();
const port = 3001;

// Allow React app to make requests to this server
app.use(cors());

// Your stock and news API keys (replace with actual ones)
const STOCK_API_KEY = SzChEyokFm3NzUhn5ziNexxSkuwI3vsJ; // Replace with your Polygon.io API key
const NEWS_API_KEY = c564f9d0488e499c9978b8657737db7d; // Replace with your news API key

// Endpoint to get stock data and news
app.get("/stocks", async (req, res) => {
  try {
    // Fetch stock data from Polygon.io (we'll use the previous close price)
    const stockResponse = await axios.get(`https://api.polygon.io/v2/aggs/ticker/AAPL/prev`, {
      params: {
        apiKey: SzChEyokFm3NzUhn5ziNexxSkuwI3vsJ, // Replace with your Polygon.io API key
      },
    });

    // Get the latest stock data (previous close price)
    const latestPrice = stockResponse.data.results[0].c; // Closing price (last price)
    const prevPrice = stockResponse.data.results[0].o; // Open price (or you can use previous day's close if you have that data)

    // Check if the stock is going up (green market)
    const isGreenMarket = parseFloat(latestPrice) > parseFloat(prevPrice);

    // Fetch news if it's a green market
    let stockNews = [];
    if (isGreenMarket) {
      const newsResponse = await axios.get("https://newsapi.org/v2/everything", {
        params: {
          q: "stock market",
          apiKey: SzChEyokFm3NzUhn5ziNexxSkuwI3vsJ, // Replace with your NewsAPI key
        },
      });
      stockNews = newsResponse.data.articles;
    }

    // Send the result back to React
    res.json({ isGreenMarket, stockNews });
  } catch (error) {
    console.error(error);
    res.status(500).send("Error fetching data");
  }
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
