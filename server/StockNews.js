import React, { useEffect, useState } from "react";
import axios from "axios";

const StockNews = () => {
  const [stockData, setStockData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Fetch data from Express API
    axios.get("http://localhost:3001/stocks")
      .then((response) => {
        setStockData(response.data);
        setLoading(false);
      })
      .catch((error) => {
        console.error("Error fetching stock data:", error);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div>Loading...</div>;
  }

  return (
    <div>
      <h1>{stockData.isGreenMarket ? "Green Market!" : "Stock is Down"}</h1>
      {stockData.isGreenMarket && (
        <div>
          <h2>Stock News</h2>
          <ul>
            {stockData.stockNews.map((article, index) => (
              <li key={index}>
                <a href={article.url} target="_blank" rel="noopener noreferrer">
                  {article.title}
                </a>
                <p>{article.description}</p>
              </li>
            ))}
          </ul>
        </div>
      )}
    </div>
  );
};

export default StockNews;
