// server/index.js
const express = require("express");
const app = express();
const PORT = process.env.PORT || 3001;

// Import the API routes
const apiRoutes = require("./api");

// Use the API routes
app.use("/api", apiRoutes);

// Start the server
app.listen(PORT, () => {
  console.log(`Server listening on ${PORT}`);
});
