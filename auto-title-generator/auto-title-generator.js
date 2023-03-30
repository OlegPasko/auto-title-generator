(function () {
    const editor = wp.data.select('core/editor');

    function addButtonToSidebar(id, label, type) {
        const button = document.createElement('button');
        button.id = id;
        button.textContent = label;
        button.classList.add('button', 'button-primary');
        button.style.marginRight = '10px';
        button.addEventListener('click', async () => {
            const content = editor.getEditedPostContent();
            let prompt;

            switch (type) {
                case 'formal':
                    prompt = 'Generate a short post title based on the provided content. Post title should be formal and informative. Dont use quotes in repsonse';
                    break;
                case 'clickbait':
                    prompt = 'Generate a short post title based on the provided content. Title has to be a clickbait, so users want to click it. Dont use quotes in repsonse';
                    break;
                case 'social':
                    prompt = 'Generate a short post title based on the provided content. Title has to be good for using in social media like Facebook, so users want to click it while scrolling their feed. Dont use quotes in repsonse';
                    break;
            }

            const response = await fetch('/wp-json/atg/v1/generate_title', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ content, prompt }),
            });            

            const data = await response.json();
            const title = data.title;
            if (title) {
                wp.data.dispatch('core/editor').editPost({ title });
            }
        });

        const sidebar = document.querySelector('.edit-post-sidebar');
        if (sidebar) {
            const buttonContainer = sidebar.querySelector('.atg-button-container');
            if (!buttonContainer) {
                const container = document.createElement('div');
                container.className = 'atg-button-container';
                container.style.padding = '5px';
                sidebar.appendChild(container);
            }
            sidebar.querySelector('.atg-button-container').appendChild(button);
        }
    }

    setTimeout(() => {
        addButtonToSidebar('atg-formal-button', 'Formal', 'formal');
        addButtonToSidebar('atg-clickbait-button', 'Click bait', 'clickbait');
        addButtonToSidebar('atg-social-button', 'Social best', 'social');
    }, 1000);
})();
