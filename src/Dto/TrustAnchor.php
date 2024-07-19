<?php

namespace Authlete\Dto;

/**
 * Trust anchor.
 *
 *
 * @see https://openid.net/specs/openid-federation-1_0.html OpenID Federation 1.0
 */
class TrustAnchor
{

    /**
     * The entity ID of the trust anchor.
     */
    private String $entityId; // URI

    /**
     * The JWK Set document containing public keys of the trust anchor.
     */
    private String $jwks;

    /**
     * Get the entity ID of the trust anchor.
     *
     * @return string
     *         The entity ID.
     */
    public function getEntityId(): string
    {
        return $this->entityId;
    }

    /**
     * Set the entity ID of the trust anchor.
     *
     * @param string $entityId
     *         The entity ID.
     *
     * @return TrustAnchor
     */
    public function setEntityId(string $entityId): TrustAnchor
    {
        $this->entityId = $entityId;
        return $this;
    }

    /**
     * Get the JWK Set document containing public keys of the trust anchor.
     *
     * <p>
     * The keys are used to verify signatures of entity statements issued
     * by the trust anchor.
     * </p>
     *
     * @return string
     *         The JWK Set document containing public keys of the trust anchor.
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html RFC 7517 JSON Web Key (JWK)
     */
    public function getJwks(): string
    {
        return $this->jwks;
    }

    /**
     * Get the JWK Set document containing public keys of the trust anchor.
     *
     * <p>
     * The keys are used to verify signatures of entity statements issued
     * by the trust anchor.
     * </p>
     *
     * @param string $jwks
     *
     * @return TrustAnchor
     *         The JWK Set document containing public keys of the trust anchor.
     *
     * @see https://www.rfc-editor.org/rfc/rfc7517.html RFC 7517 JSON Web Key (JWK)
     */
    public function setJwks(string $jwks): TrustAnchor
    {
        $this->jwks = $jwks;
        return $this;
    }

}