function heartAnim(elementId) {
    const data = 'https://assets1.lottiefiles.com/datafiles/d9bc9kYC2VttaKb/data.json';
    const container = document.querySelector('#' + elementId);
    let isActive = false;

    const animation = bodymovin.loadAnimation({
        container: container,
        path: data,
        renderer: 'svg',
        loop: false,
        autoplay: false
    });

    container.addEventListener('click', function (e) {
        e.preventDefault();

        isActive = $(this).hasClass('is-active');
        let commentLikeElement = $("#" + elementId).parent('div').find(".comment-likes");
        let like_num = $(this).data('like-num');
        let messages = '';
        if (isActive) {
            container.classList.remove('is-active');
            commentLikeElement.removeClass("liked");
            $(this).data('like-num', like_num - 1);
            like_num = $(this).data('like-num');
            animation.stop();
        } else {
            container.classList.add('is-active');
            commentLikeElement.addClass("liked");
            $(this).data('like-num', like_num + 1);
            like_num = $(this).data('like-num');
            setTimeout(() => {
                animation.play();
            }, 20);
        }
        messages = (like_num > 0 ? like_num + '  users liked this.' : (like_num == 0 ? '' : like_num));

        isActive = !isActive;

        let utype = -1;
        if($(this).hasClass('is-active')) {
            console.log('+');
            utype = 1;
        } else {
            utype = 0;
        }
        let uid = $(this).data('uid');

        let postData = {
            uid: uid,
            utype: utype
        };

        $.ajax({
            url: '/news/like-comment',
            method: 'POST',
            dataType: 'JSON',
            data: postData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(res) {
                commentLikeElement.text(messages);
            },
            error: function(err) {

            }
        });
    });

    animation.addEventListener('complete', () => {
        animation.stop();
    })
}
