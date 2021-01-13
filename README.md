Ovo je testni Laravel api projekat za prijavu za posao.

Na početku sam imao 2 opcije da radim full-stack ili backend. Na backend sam se odlučio iz razloga što se za frontend treba koristiti Tailwind a ja ga slabo poznajem.

Čitanjem zadatka shvatio sam otprilike strukturu projekta i šta je potrebno uraditi. Projekat ima 3 glavne tabele users, sections i offers. Offers ima 2 tuđa ključa users_id i sections_id. Ti ključevi prdstavljaju način povezivanja tabela odnosno 1 na 1 vezu između users i offers tabele te 1 ima više vezu  između sections i offers tabele.

Nakon izrade migracija po dostavljenoj specifikaciji uradio  sam seedere za iste tabele koristeći Faker - PHP biblioteku koja pomaže generisanju podataka.
Zatim sam kreirao autentifikaciju korisnika koristeći Laravel Passport. To je jedan od klasičnih načina izrade autentifikacije za api endpointe. 
Na kraju sam napravio RESTful API endpointe za offers i sections kako bih omogućio CRUD operacije zahtjevane zadatkom. Nakon kreiranja endpointa pristupio sam testiranju koristeći Postman. 
