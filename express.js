import express from 'express';
import cors from "cors";
const app = express();
import SSE_Manager from './node/SSE_Manager.js';
import { config } from "dotenv";
config();

const corsOptions = {
  origin: ['http://localhost:8000'],
  credentials: true // Enable credentials (cookies, authorization headers, etc.)
};

app.use(express.urlencoded({extended:true}))
app.use(express.json());
app.use(cors(corsOptions));

function getCookieValue(cookieString='', key) {
    const cookies = cookieString.split(';');
    
    for (let i = 0; i < cookies.length; i++) {
      const [cookieKey, cookieValue] = cookies[i].split('=');
      
      if (cookieKey.trim() === key) {
        return cookieValue.trim();
      }
    }
    
    return null; // Return null if the cookie key is not found
}

app.get('/sse-endpoint',(req,res) => {;
  
    console.log(getCookieValue( req.headers.cookie, 'laravel_session'));

    res.setHeader('Content-Type', 'text/event-stream');
    res.setHeader('Cache-Control', 'no-cache');
    res.setHeader('Connection', 'keep-alive');

    // [Subscribe to SEE devices]
    SSE_Manager.subscribe('notification', getCookieValue( req.headers.cookie, 'laravel_session'), res);

    // Close SSE connection on request termination
    req.on('close', () => {
        console.log('exit');
        SSE_Manager.unsubscribe(getCookieValue( req.headers.cookie, 'laravel_session'));
    });
})

app.post('/sse-webhook',(req,res) => {
   const { channel, data } = req.body;
   const token = req.headers.authorization;

   console.log("SSE_KEY:",process.env.SSE_KEY);
   console.log("Laravel SSE_KEY", `Bearer ${token}`) 
    if (!token || token !== `Bearer ${process.env.SSE_KEY}`) {
      return res.status(401).json({ error: 'Unauthorized' });
    }

   if(channel && data ){
      SSE_Manager.publish(channel, {channel, data});
      res.sendStatus(200);
      return;
   }
   res.sendStatus(500);
})

// For Blade:
/*   
 (data) => {
    const data_json = JSON.parse(data.data);
    console.log(data.data);
    alert(`Hi There Monsieur ${data_json.data} on Channel ${data_json.channel}`)
  }
*/

app.listen(8080,() => {
    console.log("SSE Endpoint up and running on ", 8080)
})