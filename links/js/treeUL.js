let tree = document.getElementById("tree");

if (tree != null)
    tree.onclick = function (event) {
        let span = event.target;
        if(span.tagName != 'SPAN'){
            if(!span.classList.contains('tree_target')){
                return;
            }
            while(span.tagName != 'SPAN'){
                console.log("find - " + span.tagName);
                span = span.parentNode;
            }
        }

        let childrenContainer = span.parentNode.querySelector('ul');

        if (!childrenContainer) return;

        childrenContainer.hidden = !childrenContainer.hidden;

        tree = document.getElementById("tree");
        if (childrenContainer.hidden) {
            span.classList.add('hide');
            span.classList.remove('show');
        }
        else {
            span.classList.add('show');
            span.classList.remove('hide');
        }
    }