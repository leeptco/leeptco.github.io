const App = {
    data() {
        return {
            person: {
                fio: '',
                age: null
            },
            children: []
        }
    },

    computed: {
        // Проверка на наличие ошибок в данных детей
        hasErrors() {
            return this.children.some(child => child.ageWarning) || this.person.ageWarning;
        }
    },

    methods: {
        addNewChild() {
            if (this.children.length < 5) {
                this.children.push({ name: '', age: null, ageWarning: '' }); // Добавляем нового ребенка с пустыми значениями 
            }
        },
        // Удаляем строку с ребенком по индексу 
        removeChild(index) {
            this.children.splice(index, 1);
        },
        saveData() {
            // Проверка на ошибки перед сохранением
            if (this.hasErrors) {
                alert('Пожалуйста, исправьте ошибки в форме перед сохранением.');
                return;
            }

            // Сохраняем данные в localStorage 
            const dataToSave = {
                person: this.person,
                children: this.children
            };
            localStorage.setItem('formData', JSON.stringify(dataToSave));

            // Перенаправление на страницу preview.html 
            window.location.href = 'preview.html';
        },

        checkChildAge(index) {
            const parentAge = this.person.age;
            const childAge = this.children[index].age;

            // Сброс предупреждения, если поле пустое или возраст ребенка не введен
            this.children[index].ageWarning = '';

            // Проверяем разницу в возрасте у родителя и детей
            if (parentAge && childAge !== null) {
                if (childAge < 0) {
                    this.children[index].ageWarning =
                        'Возраст должен быть не менее 1 года.';
                }
                else if (parentAge < childAge) {
                    this.children[index].ageWarning =
                        'Ребенок не может быть старше родителя. Введите корректный возраст.';
                }
                else if (parentAge - childAge < 12) {
                    this.children[index].ageWarning =
                        'Родителем в таком раннем возрасте не становятся)) может вы ошиблись в возрасте своего ребенка?)';
                }

            }

        },
        checkPersonAge() {
            const parentAge = this.person.age;

            // Сброс предупреждения, если поле пустое или возраст не введен
            this.person.ageWarning = '';

            // Проверяем допустимость возраста родителя
            if (parentAge < 1) {
                this.person.ageWarning = 'Возраст должен быть не менее 1 года.';
            } else if (parentAge > 100) {
                this.person.ageWarning = 'Максимальный допустимый возраст составляет 100 лет.';
            }
        }
    }
}

Vue.createApp(App).mount('#app')