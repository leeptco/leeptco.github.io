
const textContainer = document.getElementById('video-text');
const nodes = Array.from(textContainer.childNodes);

textContainer.innerHTML = '';

nodes.forEach(node => {
    if (node.nodeType === Node.TEXT_NODE) {
        node.textContent
            .split(' ')
            .filter(word => word.trim())
            .forEach(word => {
                const span = document.createElement('span');
                span.textContent = word;
                textContainer.appendChild(span);
                textContainer.appendChild(document.createTextNode(' '));
            });
    } else {
        textContainer.appendChild(node);
    }
});