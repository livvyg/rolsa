import React, { useState } from "react";
import StockNews from './StockNews'; // Import StockNews component

const App = () => {
  const [symbol, setSymbol] = useState(""); 

  return (
    <div>
      <h1>Stock Price Viewer</h1>
      <input
        type="text"
        value={symbol}
        onChange={(e) => setSymbol(e.target.value)}
        placeholder="Enter stock symbol"
      />
      {symbol && <StockNews symbol={symbol} />} {/* Only render StockNews if a symbol is entered */}
    </div>
  );
};

export default App;