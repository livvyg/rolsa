const express = require("express");
const router = express.Router();

// API route to send a message
router.get("/", (req, res) => {
  res.send("Hello from server");
});

module.exports = router;
