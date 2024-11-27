const App = {
    data() {
        return {
            person: {},
            children: []
        };
    },
    created() {
        // Получаем данные из localStorage при создании компонента
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
            this.person = savedData.person;
            this.children = savedData.children;
        } else {
            document.getElementById('person-info').textContent = 'Данные отсутствуют';
        }
    },
    methods: {
        textForAge(age) {
            let textAge;
            const lastDigit = age % 10;
            const lastTwoDigits = age % 100;

            if (lastDigit === 1 && lastTwoDigits !== 11) {
                textAge = 'год';
            } else if ((lastDigit === 2 || lastDigit === 3 || lastDigit === 4) && (lastTwoDigits < 12 || lastTwoDigits > 14)) {
                textAge = 'года';
            } else {
                textAge = 'лет';
            }

            return `${age} ${textAge}`;
        }
    },
};

Vue.createApp(App).mount('#appPreview')