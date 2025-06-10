<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with GPT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Chat with ChatGPT</h1>

    <textarea id="message" rows="4" cols="50"></textarea><br>
    <button onclick="sendMessage()">Send</button>

    <p><strong>Response:</strong></p>
    <div id="response"></div>

<script>
  async function sendMessage() {
    const message = document.getElementById('message').value;

    const res = await fetch('/ask', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ message })
    });

    // Get raw text first
    const text = await res.text();

    try {
      // Try to parse JSON
      const data = JSON.parse(text);

      if (data.reply) {
        document.getElementById('response').innerText = data.reply;
      } else if (data.error) {
        document.getElementById('response').innerText = 'Error: ' + data.message;
      } else {
        document.getElementById('response').innerText = 'Unexpected JSON: ' + text;
      }
    } catch (err) {
      // If parsing fails, show raw text so you can see the error or HTML
      document.getElementById('response').innerText =
        'Response was not valid JSON:\n' + text;
    }
  }
</script>

</body>
</html>
