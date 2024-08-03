erDiagram
    USERS {
        int id PK
        string name
        string email
        string phone_number
        string password
        enum role
        timestamps timestamps
    }
    RESTAURANTS {
        int id PK
        string name
        string address
        string phone_number
        string email
        string cuisine_type
        int owner_id FK
        timestamps timestamps
    }
    RESERVATIONS {
        int id PK
        int user_id FK
        int restaurant_id FK
        date reservation_date
        time reservation_time
        int number_of_people
        text special_requests
        enum status
        timestamps timestamps
    }
    REVIEWS {
        int id PK
        int user_id FK
        int restaurant_id FK
        int rating
        text comment
        date review_date
        timestamps timestamps
    }
    FAVORITES {
        int id PK
        int user_id FK
        int restaurant_id FK
        timestamps timestamps
    }

    USERS ||--o{ RESTAURANTS : "owns"
    USERS ||--o{ RESERVATIONS : "makes"
    USERS ||--o{ REVIEWS : "writes"
    USERS ||--o{ FAVORITES : "favorites"
    RESTAURANTS ||--o{ RESERVATIONS : "receives"
    RESTAURANTS ||--o{ REVIEWS : "receives"
    RESTAURANTS ||--o{ FAVORITES : "is favorited"