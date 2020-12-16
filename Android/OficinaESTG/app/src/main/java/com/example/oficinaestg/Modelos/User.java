package com.example.oficinaestg.Modelos;

public class User {
    private int id, status, created_at, updated_at;
    private String username, auth_key, email, password_hash, password_reset_token,verification_token, password;

    public User(int id, int status, String username, String auth_key, String email, int created_at, int updated_at, String password_hash, String password_reset_token, String verification_token, String password){
            this.id=id;
            this.status=status;
            this.username=username;
            this.auth_key=auth_key;
            this.email=email;
            this.created_at=created_at;
            this.updated_at=updated_at;
            this.password_hash=password_hash;
            this.password_reset_token=password_reset_token;
            this.verification_token=verification_token;
            this.password=password;
    }

    public int getId() {
        return id;
    }

    public int getStatus() {
        return status;
    }

    public String getUsername() {
        return username;
    }

    public String getAuth_key() {
        return auth_key;
    }

    public String getEmail() {
        return email;
    }

    public int getCreated_at() {
        return created_at;
    }

    public int getUpdated_at() {
        return updated_at;
    }

    public String getPassword_hash() {
        return password_hash;
    }

    public String getPassword_reset_token() {
        return password_reset_token;
    }

    public String getVerification_token() {
        return verification_token;
    }

    public String getPassword() {
        return password;
    }
}
