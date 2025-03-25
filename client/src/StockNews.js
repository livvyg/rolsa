// StockNews.js
import React, { useEffect, useState } from "react";
import axios from "axios"; // To make API requests

const StockNews = ({ symbol }) => {
  const [stockData, setStockData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Fetch stock data whenever the symbol changes
  useEffect(() => {
    const fetchStockData = async () => {
      try {
        setLoading(true);
        const response = await axios.get(`http://localhost:5000/api/stock/${symbol}`);
        setStockData(response.data);
      } catch (err) {
        setError("Failed to fetch stock data.");
      } finally {
        setLoading(false);
      }
    };

    if (symbol) {
      fetchStockData();
    }
  }, [symbol]); // Re-fetch when symbol changes

  // Show loading or error state
  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  // Render the stock data
  return (
    <div>
      <h3>Stock Data for {symbol}</h3>
      {stockData ? (
        <pre>{JSON.stringify(stockData, null, 2)}</pre> // Display raw stock data (you can format it)
      ) : (
        <p>No data available.</p>
      )}
    </div>
  );
};

export default StockNews;
