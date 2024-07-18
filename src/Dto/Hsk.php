<?php

namespace Authlete\Dto;

class Hsk
{

    private string $kty;
    private string $use;
    private string $alg;
    private string $kid;
    private string $hsmName;
    private string $handle;
    private string $publicKey;


    /**
     * Get the key type of the key on the HSM.
     *
     * @return String The key type.
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.1
     * RFC 7517 JSON Web Key (JWK), 4.1. "kty" (Key Type) Parameter
     */
    public function getKty(): string
    {
        return $this->kty;
    }


    /**
     * Set the key type of the key on the HSM.
     *
     * @param String $kty
     * @return Hsk
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.1
     * RFC 7517 JSON Web Key (JWK), 4.1. "kty" (Key Type) Parameter
     */
    public function setKty(string $kty): Hsk
    {
        $this->kty = $kty;

        return $this;
    }


    /**
     * Get the use of the key on the HSM.
     *
     * <p>
     * When the key use is {@code "sig"} (signature), the private key on the
     * HSM is used to sign data and the corresponding public key is used to
     * verify the signature.
     * </p>
     *
     * <p>
     * When the key use is {@code "enc"} (encryption), the private key on the
     * HSM is used to decrypt encrypted data which have been encrypted with the
     * corresponding public key.
     * </p>
     *
     * @return string
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.2
     * RFC 7517 JSON Web Key (JWK), 4.2. "use" (Public Key Use) Parameter
     */
    public function getUse(): string
    {
        return $this->use;
    }


    /**
     * Set the use of the key on the HSM.
     *
     * <p>
     * When the key use is {@code "sig"} (signature), the private key on the
     * HSM is used to sign data and the corresponding public key is used to
     * verify the signature.
     * </p>
     *
     * <p>
     * When the key use is {@code "enc"} (encryption), the private key on the
     * HSM is used to decrypt encrypted data which have been encrypted with the
     * corresponding public key.
     * </p>
     *
     * @param string $use
     * @return Hsk
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.2
     *      RFC 7517 JSON Web Key (JWK), 4.2. "use" (Public Key Use) Parameter
     */
    public function setUse(string $use): Hsk
    {
        $this->use = $use;

        return $this;
    }


    /**
     * Get the algorithm of the key on the HSM.
     *
     * <p>
     * When the key use is {@code "sig"}, the algorithm represents a signing
     * algorithm such as {@code "ES256"}.
     * </p>
     *
     * <p>
     * When the key use is {@code "enc"}, the algorithm represents an
     * encryption algorithm such as {@code "RSA-OAEP-256"}.
     * </p>
     *
     * @return string
     *    The algorithm.
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.4
     *      RFC 7517 JSON Web Key (JWK), 4.4. "alg" (Algorithm) Parameter
     *
     * @see https://www.rfc-editor.org/rfc/rfc7518.html#section-3.1
     *      RFC 7518 JSON Web Algorithms (JWA), 3.1. "alg" (Algorithm) Header Parameter Values for JWS
     *
     * @see https://www.rfc-editor.org/rfc/rfc7518.html#section-4.1
     *      RFC 7518 JSON Web Algorithms (JWA), 4.1. "alg" (Algorithm) Header Parameter Values for JWE
     */
    public function getAlg(): string
    {
        return $this->alg;
    }


    /**
     * Set the algorithm of the key on the HSM.
     *
     * <p>
     * When the key use is {@code "sig"}, the algorithm represents a signing
     * algorithm such as {@code "ES256"}.
     * </p>
     *
     * <p>
     * When the key use is {@code "enc"}, the algorithm represents an
     * encryption algorithm such as {@code "RSA-OAEP-256"}.
     * </p>
     *
     * @param String $alg
     * @return Hsk
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.4
     *      RFC 7517 JSON Web Key (JWK), 4.4. "alg" (Algorithm) Parameter
     *
     * @see https://www.rfc-editor.org/rfc/rfc7518.html#section-3.1
     *      RFC 7518 JSON Web Algorithms (JWA), 3.1. "alg" (Algorithm) Header Parameter Values for JWS
     *
     * @see https://www.rfc-editor.org/rfc/rfc7518.html#section-4.1
     *      RFC 7518 JSON Web Algorithms (JWA), 4.1. "alg" (Algorithm) Header Parameter Values for JWE
     */
    public function setAlg(string $alg): Hsk
    {
        $this->alg = $alg;

        return $this;
    }


    /**
     * Get the key ID for the key on the HSM.
     *
     * @return String
     *         The key ID.
     *
     * @see "https://www.rfc-editor.org/rfc/rfc7517.html#section-4.5
     *      RFC 7517 JSON Web Key (JWK), 4.5. "kid" (Key ID) Parameter
     */
    public function getKid(): string
    {
        return $this->kid;
    }


    /**
     * Set the key ID for the key on the HSM.
     *
     * @param string $kid
     *         The key ID.
     *
     * @return Hsk
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html#section-4.5
     *      RFC 7517 JSON Web Key (JWK), 4.5. "kid" (Key ID) Parameter
     */
    public function setKid(string $kid): Hsk
    {
        $this->kid = $kid;

        return $this;
    }


    /**
     * Get the name of the HSM.
     *
     * <p>
     * The identifier for the HSM that sits behind the Authlete server.
     * For example, {@code "google"}.
     * </p>
     *
     * @return String
     *      The name of the HSM.
     */
    public function getHsmName(): string
    {
        return $this->hsmName;
    }


    /**
     * Set the name of the HSM.
     *
     * <p>
     * The identifier for the HSM that sits behind the Authlete server.
     * For example, {@code "google"}.
     * </p>
     *
     * @param string $hsmName
     *         The name of the HSM.
     *
     * @return Hsk
     *
     */
    public function setHsmName(string $hsmName): Hsk
    {
        $this->hsmName = $hsmName;

        return $this;
    }


    /**
     * Get the handle for the key on the HSM.
     *
     * <p>
     * A handle is a base64url-encoded 256-bit random value (43 letters)
     * which is assigned by Authlete on the call of the {@code /api/hsk/create}
     * API.
     * </p>
     *
     * <p>
     * A handle is needed to call the <code>/api/hsk/get/{handle}</code> API
     * and the <code>/api/hsk/delete/{handle}</code> API.
     * </p>
     *
     * @return String The handle.
     *
     */
    public function getHandle(): string
    {
        return $this->handle;
    }


    /**
     * Set the handle for the key on the HSM.
     *
     * <p>
     * A handle is a base64url-encoded 256-bit random value (43 letters)
     * which is assigned by Authlete on the call of the {@code /api/hsk/create}
     * API.
     * </p>
     *
     * <p>
     * A handle is needed to call the <code>/api/hsk/get/{handle}</code> API
     * and the <code>/api/hsk/delete/{handle}</code> API.
     * </p>
     *
     * @param string $handle
     *         The handle.
     *
     * @return Hsk
     *
     */
    public function setHandle(string $handle): Hsk
    {
        $this->handle = $handle;

        return $this;
    }


    /**
     * Get the public key that corresponds to the key on the HSM.
     *
     * @return string
     *       The public key in base64-encoded DER format.
     *
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }


    /**
     * Set the public key that corresponds to the key on the HSM.
     *
     * @param String $publicKey
     *         The public key in base64-encoded DER format.
     *
     * @return Hsk
     *
     */
    public function setPublicKey(String $publicKey): Hsk
    {
        $this->publicKey = $publicKey;

        return $this;
    }

}