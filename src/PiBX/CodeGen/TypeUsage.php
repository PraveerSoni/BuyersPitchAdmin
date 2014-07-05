<?php
/**
 * Copyright (c) 2010, Christoph Gockel.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 * * Neither the name of PiBX nor the names of its contributors may be used
 *   to endorse or promote products derived from this software without specific
 *   prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
require_once '../PiBX/ParseTree/BaseType.php';
/**
 * A TypeUsage-object is used as a reference counter for defined types
 * (complex and simple) in a schema.
 * 
 * For example: a defined type, which is never referenced or used, can be
 * removed completely without informaion loss.
 *
 * @author Christoph Gockel
 */
class PiBX_CodeGen_TypeUsage {
    /**
     * @var array A map with usage informations: type => usage count
     */
    private $typeUsage;
    
    public function __construct() {
        $this->typeUsage = array();
    }
    
    public function addType($type) {
        if (PiBX_ParseTree_BaseType::isBaseType($type)) {
            // there is no interest in base-type usages
            return;
        }
        
        if (trim($type) === '') {
            // and no interest in "empty" types as well
            return;
        }
        
        if ( !isset($this->typeUsage[$type]) ) {
            $this->typeUsage[$type] = 0;
        }

        $this->typeUsage[$type]++;
    }

    /**
     *
     * @return array Hash with type => count
     */
    public function getTypeUsages() {
        return $this->typeUsage;
    }
}
