<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Collections\Expr;

/**
 * Walks an expression graph and turns it into a PHP closure.
 *
 * This closure can be used with {@Collection#filter()} and is used internally
 * by {@ArrayCollection#select()}.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 * @since  2.3
 */
class ClosureExpressionVisitor extends ExpressionVisitor
{
    /**
     * Accesses the field of a given object. This field has to be public
     * directly or indirectly (through an accessor get*, is*, or a magic
     * method, __get, __call).
     *
<<<<<<< HEAD
     * @param object|array $object
=======
     * @param object $object
>>>>>>> pantheon-drops-8/master
     * @param string $field
     *
     * @return mixed
     */
    public static function getObjectFieldValue($object, $field)
    {
        if (is_array($object)) {
            return $object[$field];
        }

<<<<<<< HEAD
        $accessors = ['get', 'is'];
=======
        $accessors = array('get', 'is');
>>>>>>> pantheon-drops-8/master

        foreach ($accessors as $accessor) {
            $accessor .= $field;

            if ( ! method_exists($object, $accessor)) {
                continue;
            }

            return $object->$accessor();
        }

        // __call should be triggered for get.
        $accessor = $accessors[0] . $field;

        if (method_exists($object, '__call')) {
            return $object->$accessor();
        }

        if ($object instanceof \ArrayAccess) {
            return $object[$field];
        }

<<<<<<< HEAD
        if (isset($object->$field)) {
            return $object->$field;
        }

        // camelcase field name to support different variable naming conventions
        $ccField   = preg_replace_callback('/_(.?)/', function($matches) { return strtoupper($matches[1]); }, $field);

        foreach ($accessors as $accessor) {
            $accessor .= $ccField;


            if ( ! method_exists($object, $accessor)) {
                continue;
            }

            return $object->$accessor();
        }

=======
>>>>>>> pantheon-drops-8/master
        return $object->$field;
    }

    /**
     * Helper for sorting arrays of objects based on multiple fields + orientations.
     *
     * @param string   $name
     * @param int      $orientation
     * @param \Closure $next
     *
     * @return \Closure
     */
    public static function sortByField($name, $orientation = 1, \Closure $next = null)
    {
        if ( ! $next) {
<<<<<<< HEAD
            $next = function() : int {
=======
            $next = function() {
>>>>>>> pantheon-drops-8/master
                return 0;
            };
        }

<<<<<<< HEAD
        return function ($a, $b) use ($name, $next, $orientation) : int {
=======
        return function ($a, $b) use ($name, $next, $orientation) {
>>>>>>> pantheon-drops-8/master
            $aValue = ClosureExpressionVisitor::getObjectFieldValue($a, $name);
            $bValue = ClosureExpressionVisitor::getObjectFieldValue($b, $name);

            if ($aValue === $bValue) {
                return $next($a, $b);
            }

            return (($aValue > $bValue) ? 1 : -1) * $orientation;
        };
    }

    /**
     * {@inheritDoc}
     */
    public function walkComparison(Comparison $comparison)
    {
        $field = $comparison->getField();
        $value = $comparison->getValue()->getValue(); // shortcut for walkValue()

        switch ($comparison->getOperator()) {
            case Comparison::EQ:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
=======
                return function ($object) use ($field, $value) {
>>>>>>> pantheon-drops-8/master
                    return ClosureExpressionVisitor::getObjectFieldValue($object, $field) === $value;
                };

            case Comparison::NEQ:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
=======
                return function ($object) use ($field, $value) {
>>>>>>> pantheon-drops-8/master
                    return ClosureExpressionVisitor::getObjectFieldValue($object, $field) !== $value;
                };

            case Comparison::LT:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
=======
                return function ($object) use ($field, $value) {
>>>>>>> pantheon-drops-8/master
                    return ClosureExpressionVisitor::getObjectFieldValue($object, $field) < $value;
                };

            case Comparison::LTE:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
=======
                return function ($object) use ($field, $value) {
>>>>>>> pantheon-drops-8/master
                    return ClosureExpressionVisitor::getObjectFieldValue($object, $field) <= $value;
                };

            case Comparison::GT:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
=======
                return function ($object) use ($field, $value) {
>>>>>>> pantheon-drops-8/master
                    return ClosureExpressionVisitor::getObjectFieldValue($object, $field) > $value;
                };

            case Comparison::GTE:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
=======
                return function ($object) use ($field, $value) {
>>>>>>> pantheon-drops-8/master
                    return ClosureExpressionVisitor::getObjectFieldValue($object, $field) >= $value;
                };

            case Comparison::IN:
<<<<<<< HEAD
                return function ($object) use ($field, $value) : bool {
                    return in_array(ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value, true);
                };

            case Comparison::NIN:
                return function ($object) use ($field, $value) : bool {
                    return ! in_array(ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value, true);
=======
                return function ($object) use ($field, $value) {
                    return in_array(ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value);
                };

            case Comparison::NIN:
                return function ($object) use ($field, $value) {
                    return ! in_array(ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value);
>>>>>>> pantheon-drops-8/master
                };

            case Comparison::CONTAINS:
                return function ($object) use ($field, $value) {
                    return false !== strpos(ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value);
                };

<<<<<<< HEAD
            case Comparison::MEMBER_OF:
                return function ($object) use ($field, $value) : bool {
                    $fieldValues = ClosureExpressionVisitor::getObjectFieldValue($object, $field);
                    if (!is_array($fieldValues)) {
                        $fieldValues = iterator_to_array($fieldValues);
                    }
                    return in_array($value, $fieldValues, true);
                };

            case Comparison::STARTS_WITH:
                return function ($object) use ($field, $value) : bool {
                    return 0 === strpos(ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value);
                };

            case Comparison::ENDS_WITH:
                return function ($object) use ($field, $value) : bool {
                    return $value === substr(ClosureExpressionVisitor::getObjectFieldValue($object, $field), -strlen($value));
                };


=======
>>>>>>> pantheon-drops-8/master
            default:
                throw new \RuntimeException("Unknown comparison operator: " . $comparison->getOperator());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function walkValue(Value $value)
    {
        return $value->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function walkCompositeExpression(CompositeExpression $expr)
    {
<<<<<<< HEAD
        $expressionList = [];
=======
        $expressionList = array();
>>>>>>> pantheon-drops-8/master

        foreach ($expr->getExpressionList() as $child) {
            $expressionList[] = $this->dispatch($child);
        }

        switch($expr->getType()) {
            case CompositeExpression::TYPE_AND:
                return $this->andExpressions($expressionList);

            case CompositeExpression::TYPE_OR:
                return $this->orExpressions($expressionList);

            default:
                throw new \RuntimeException("Unknown composite " . $expr->getType());
        }
    }

    /**
     * @param array $expressions
     *
     * @return callable
     */
<<<<<<< HEAD
    private function andExpressions(array $expressions) : callable
    {
        return function ($object) use ($expressions) : bool {
=======
    private function andExpressions($expressions)
    {
        return function ($object) use ($expressions) {
>>>>>>> pantheon-drops-8/master
            foreach ($expressions as $expression) {
                if ( ! $expression($object)) {
                    return false;
                }
            }
<<<<<<< HEAD

=======
>>>>>>> pantheon-drops-8/master
            return true;
        };
    }

    /**
     * @param array $expressions
     *
     * @return callable
     */
<<<<<<< HEAD
    private function orExpressions(array $expressions) : callable
    {
        return function ($object) use ($expressions) : bool {
=======
    private function orExpressions($expressions)
    {
        return function ($object) use ($expressions) {
>>>>>>> pantheon-drops-8/master
            foreach ($expressions as $expression) {
                if ($expression($object)) {
                    return true;
                }
            }
<<<<<<< HEAD

=======
>>>>>>> pantheon-drops-8/master
            return false;
        };
    }
}
