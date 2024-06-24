<div class="form form-v2 form-request-modal">
    <div class="form__title">Обратный звонок</div>

    <div class="form__subtitle p4">Оставьте номер телефона, мы перезвоним в течение 15 минут и проконсультируем Вас.</div>

    <div class="form__inputs">
        <div class="input">
            <label for="your-name-modal-request">Ваше имя</label>

            <input type="text" name="your-name" id="your-name-modal-request">
        </div>

        <div class="input">
            <label for="your-tel-modal-request">Телефон*</label>

            <input type="tel" name="your-tel" id="your-tel-modal-request" required>
        </div>

        <div class="input">
            <label for="your-email-modal-request">Email</label>

            <input type="email" name="your-email" id="your-email-modal-request">
        </div>

        <div class="input input-textarea">
            <label for="your-comment-modal-request">Комментарий</label>

            <textarea  name="your-comment" id="your-comment-modal-request">
            </textarea>
        </div>

        <div class="form__file file">
            <label for="file">
                <div class="form__icon">
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.61625 0H3C2.33696 0 1.70107 0.263392 1.23223 0.732233C0.763392 1.20107 0.5 1.83696 0.5 2.5V17.5C0.5 18.163 0.763392 18.7989 1.23223 19.2678C1.70107 19.7366 2.33696 20 3 20H13C13.663 20 14.2989 19.7366 14.7678 19.2678C15.2366 18.7989 15.5 18.163 15.5 17.5V5.88375C15.4999 5.55226 15.3682 5.23437 15.1337 5L10.5 0.36625C10.2656 0.131813 9.94774 7.07968e-05 9.61625 0V0ZM9.875 4.375V1.875L13.625 5.625H11.125C10.7935 5.625 10.4755 5.4933 10.2411 5.25888C10.0067 5.02446 9.875 4.70652 9.875 4.375ZM8.625 9.375V14.1163L10.0575 12.6825C10.1749 12.5651 10.334 12.4992 10.5 12.4992C10.666 12.4992 10.8251 12.5651 10.9425 12.6825C11.0599 12.7999 11.1258 12.959 11.1258 13.125C11.1258 13.291 11.0599 13.4501 10.9425 13.5675L8.4425 16.0675C8.38444 16.1257 8.31547 16.1719 8.23954 16.2034C8.16361 16.2349 8.08221 16.2511 8 16.2511C7.91779 16.2511 7.83639 16.2349 7.76046 16.2034C7.68453 16.1719 7.61556 16.1257 7.5575 16.0675L5.0575 13.5675C4.94014 13.4501 4.87421 13.291 4.87421 13.125C4.87421 12.959 4.94014 12.7999 5.0575 12.6825C5.17486 12.5651 5.33403 12.4992 5.5 12.4992C5.66597 12.4992 5.82514 12.5651 5.9425 12.6825L7.375 14.1163V9.375C7.375 9.20924 7.44085 9.05027 7.55806 8.93306C7.67527 8.81585 7.83424 8.75 8 8.75C8.16576 8.75 8.32473 8.81585 8.44194 8.93306C8.55915 9.05027 8.625 9.20924 8.625 9.375Z" fill="#39B449" />
                    </svg>
                </div>

                <span class="file__title p5">Прикрепить тех.задание</span>

                <input id="file" type="file" name="your-file" class="hidden">
            </label>
        </div>
    </div>

    <div class="policy">
        *Нажимая на кнопку, Вы соглашаетесь на
        <a href="/privacy-policy">
            обработку персональных данных
        </a>
    </div>

    <button type="submit" class="btn" form-send>
        Отправить
    </button>
</div>