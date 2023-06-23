// SSE_Manager.js

class SSE_Manager {
    static listeners = new Map();
  
    static subscribe(channel, user_session_id, response) {
      if(!this.listeners.has(user_session_id)){
        this.listeners.set(user_session_id, {
          channel: channel,
          sse_instance: response
        })
      }
    }

    static unsubscribe(user_session_id) {
      const client_sse_instance = this.listeners.get(user_session_id);
      if(client_sse_instance && client_sse_instance.sse_instance){
        client_sse_instance.sse_instance.end();
      }
      this.listeners.delete(user_session_id);
    }
  
    static publish(channel, data) {
      for (const [session_id, subscription] of this.listeners.entries()) {
        if (subscription.channel == channel) {
          console.log("test-received " + session_id + ': ' + data.id);
          const { sse_instance } = subscription;
          sse_instance.write(`data: ${JSON.stringify(data)}\n\n`);
        }
      }
    }
}

export default SSE_Manager;