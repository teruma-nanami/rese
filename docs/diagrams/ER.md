```mermaid
erDiagram
    USERS {
        bigint id PK
        varchar name
        varchar email UNIQUE
        timestamp email_verified_at
        varchar phone_number
        varchar password
        varchar password_digest
        enum role
        varchar remember_token
        timestamp created_at
        timestamp updated_at
    }
    RESTAURANTS {
        bigint id PK
        varchar name
        varchar address
        varchar phone_number
        varchar image_url
        varchar email
        varchar area
        varchar cuisine_type
        bigint owner_id FK
        timestamp created_at
        timestamp updated_at
    }
    RESERVATIONS {
        bigint id PK
        bigint user_id FK
        bigint restaurant_id FK
        date reservation_date
        time reservation_time
        integer number_of_people
        text special_requests
        enum status
        timestamp created_at
        timestamp updated_at
    }
    REVIEWS {
        bigint id PK
        bigint user_id FK
        bigint restaurant_id FK
        integer rating
        text comment
        date review_date
        timestamp created_at
        timestamp updated_at
    }
    FAVORITES {
        bigint id PK
        bigint user_id FK
        bigint restaurant_id FK
        timestamp created_at
        timestamp updated_at
    }

    USERS ||--o{ RESTAURANTS : "owns"
    USERS ||--o{ RESERVATIONS : "makes"
    USERS ||--o{ REVIEWS : "writes"
    USERS ||--o{ FAVORITES : "favorites"
    RESTAURANTS ||--o{ RESERVATIONS : "has"
    RESTAURANTS ||--o{ REVIEWS : "receives"
    RESTAURANTS ||--o{ FAVORITES : "is favorited"
